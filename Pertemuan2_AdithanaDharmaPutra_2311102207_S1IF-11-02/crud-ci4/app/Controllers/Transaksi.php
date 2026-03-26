<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\BarangModel;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $transaksiDetailModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->transaksiDetailModel = new TransaksiDetailModel();
    }

    public function detail($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to('/dashboard')->with('error', 'Transaksi tidak ditemukan');
        }

        $details = $this->transaksiDetailModel->select('transaksi_detail.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi_detail.barang_id')
            ->where('transaksi_id', $id)
            ->findAll();

        $data = [
            'view' => 'transaksi/detail',
            'title' => 'Detail Transaksi #' . $id,
            'transaksi' => $transaksi,
            'details' => $details
        ];

        return view('layout', $data);
    }

    public function edit($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to('/dashboard')->with('error', 'Transaksi tidak ditemukan');
        }

        $details = $this->transaksiDetailModel->select('transaksi_detail.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi_detail.barang_id')
            ->where('transaksi_id', $id)
            ->findAll();

        $barangModel = new BarangModel();
        $semuaBarang = $barangModel->findAll();

        $data = [
            'view' => 'transaksi/edit',
            'title' => 'Edit Transaksi #' . $id,
            'transaksi' => $transaksi,
            'details' => $details,
            'semuaBarang' => $semuaBarang
        ];

        return view('layout', $data);
    }

    public function update($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to('/dashboard')->with('error', 'Transaksi tidak ditemukan');
        }

        $barang_ids = $this->request->getPost('barang_id');
        $qtys = $this->request->getPost('qty');

        if (empty($barang_ids) || empty($qtys)) {
            return redirect()->back()->with('error', 'Harap masukkan minimal 1 barang.');
        }

        $db = \Config\Database::connect();
        $barangModel = new BarangModel();
        
        $db->transStart();

        $oldDetails = $this->transaksiDetailModel->where('transaksi_id', $id)->findAll();
        foreach ($oldDetails as $old) {
            $barangLama = $barangModel->find($old['barang_id']);
            if ($barangLama) {
                $barangModel->update($old['barang_id'], ['jumlah' => $barangLama['jumlah'] + $old['jumlah']]);
            }
        }

        $this->transaksiDetailModel->where('transaksi_id', $id)->delete();

        $total_harga = 0;
        for ($i = 0; $i < count($barang_ids); $i++) {
            $b_id = $barang_ids[$i];
            $qty = $qtys[$i];

            if ($qty <= 0) continue;

            $barang = $barangModel->find($b_id);
            if (!$barang) {
                $db->transRollback();
                return redirect()->back()->with('error', "Barang dengan ID {$b_id} tidak ditemukan.");
            }

            if ($barang['jumlah'] < $qty) {
                $db->transRollback();
                return redirect()->back()->with('error', "Stok barang {$barang['nama_barang']} tidak mencukupi (Tersisa: {$barang['jumlah']}).");
            }

            $subtotal = $barang['harga'] * $qty;
            $total_harga += $subtotal;

            $this->transaksiDetailModel->insert([
                'transaksi_id' => $id,
                'barang_id' => $b_id,
                'jumlah' => $qty,
                'harga_satuan' => $barang['harga'],
                'subtotal' => $subtotal
            ]);

            $barangModel->update($b_id, ['jumlah' => $barang['jumlah'] - $qty]);
        }
        
        $updateData = [
            'total_harga' => $total_harga
        ];
        $created_at = $this->request->getPost('created_at');
        if ($created_at) {
            $updateData['created_at'] = $created_at;
        }

        $this->transaksiModel->update($id, $updateData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memperbarui transaksi.');
        }

        session()->setFlashdata('success', 'Transaksi berhasil diperbarui beserta detail barangnya.');
        return redirect()->to('/dashboard');
    }

    public function delete($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to('/dashboard')->with('error', 'Transaksi tidak ditemukan');
        }

        $db = \Config\Database::connect();
        $barangModel = new BarangModel();
        
        $db->transStart();

        $oldDetails = $this->transaksiDetailModel->where('transaksi_id', $id)->findAll();
        foreach ($oldDetails as $old) {
            $barangLama = $barangModel->find($old['barang_id']);
            if ($barangLama) {
                $barangModel->update($old['barang_id'], ['jumlah' => $barangLama['jumlah'] + $old['jumlah']]);
            }
        }

        $this->transaksiDetailModel->where('transaksi_id', $id)->delete();
        $this->transaksiModel->delete($id);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/dashboard')->with('error', 'Gagal menghapus transaksi.');
        }

        session()->setFlashdata('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
        return redirect()->to('/dashboard');
    }
}
