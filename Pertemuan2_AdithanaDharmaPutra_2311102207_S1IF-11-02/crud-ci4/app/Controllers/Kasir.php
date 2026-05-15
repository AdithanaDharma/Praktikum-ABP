<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use CodeIgniter\API\ResponseTrait;

class Kasir extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $data = [
            'view' => 'kasir/index',
            'title' => 'Point of Sale (Kasir)'
        ];
        return view('layout', $data);
    }
    
    public function getBarang()
    {
        $kunci = $this->request->getGet('q');
        $barangModel = new BarangModel();
        
        if ($kunci) {
            $barangModel->groupStart()
                        ->like('nama_barang', $kunci)
                        ->orLike('id', $kunci)
                        ->groupEnd();
        }
        
        $data = $barangModel->where('jumlah >', 0)->findAll();
        return $this->respond($data);
    }

    public function processTransaction()
    {
        $cart = $this->request->getJSON();
        
        if (empty($cart) || !is_array($cart)) {
            return $this->fail('Keranjang kosong atau format salah.', 400);
        }
        
        $barangModel = new BarangModel();
        $transaksiModel = new TransaksiModel();
        $transaksiDetailModel = new TransaksiDetailModel();
        
        $totalHarga = 0;
        foreach ($cart as $item) {
            $barang = $barangModel->find($item->id);
            if (!$barang) {
                return $this->fail("Barang ID {$item->id} tidak ditemukan.", 404);
            }
            if ($barang['jumlah'] < $item->qty) {
                return $this->fail("Stok barang {$barang['nama_barang']} tidak mencukupi (Tersisa: {$barang['jumlah']}).", 400);
            }
            $totalHarga += ($barang['harga'] * $item->qty);
        }
        
        $db = \Config\Database::connect();
        $db->transStart();
        
        $transaksiModel->insert([
            'total_harga' => $totalHarga,
        ]);
        $transaksiId = $transaksiModel->getInsertID();
        
        foreach ($cart as $item) {
            $barang = $barangModel->find($item->id);
            $subtotal = $barang['harga'] * $item->qty;
            
            $transaksiDetailModel->insert([
                'transaksi_id' => $transaksiId,
                'barang_id'    => $barang['id'],
                'jumlah'       => $item->qty,
                'harga_satuan' => $barang['harga'],
                'subtotal'     => $subtotal
            ]);
            
            $newStock = $barang['jumlah'] - $item->qty;
            $barangModel->update($barang['id'], ['jumlah' => $newStock]);
        }
        
        $db->transComplete();
        
        if ($db->transStatus() === false) {
            return $this->failServerError('Gagal memproses transaksi.');
        }
        
        return $this->respondCreated(['message' => 'Transaksi berhasil diproses.', 'transaksi_id' => $transaksiId]);
    }
}
