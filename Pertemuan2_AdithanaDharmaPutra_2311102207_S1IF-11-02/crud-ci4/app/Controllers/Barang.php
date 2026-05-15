<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\API\ResponseTrait;

class Barang extends BaseController
{
    use ResponseTrait;

    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $kategoriList = $this->barangModel->select('kategori')->distinct()->findAll();
        return view('layout', [
            'title' => 'Manajemen Barang', 
            'view' => 'barang/index',
            'kategoriList' => $kategoriList
        ]);
    }

    public function getData()
    {
        $data = $this->barangModel->findAll();
        return $this->respond([
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('layout', ['title' => 'Tambah Barang', 'view' => 'barang/create']);
    }

    public function store()
    {
        $rules = [
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'jumlah'      => 'required|numeric',
            'harga'       => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->barangModel->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kategori'    => $this->request->getPost('kategori'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'harga'       => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = $this->barangModel->find($id);
        if (!$data) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('layout', ['title' => 'Edit Barang', 'view' => 'barang/edit', 'barang' => $data]);
    }

    public function update($id)
    {
        $rules = [
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'jumlah'      => 'required|numeric',
            'harga'       => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->barangModel->update($id, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kategori'    => $this->request->getPost('kategori'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'harga'       => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->barangModel->delete($id);
        return $this->respondDeleted(['id' => $id, 'message' => 'Data berhasil dihapus']);
    }
}
