<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $transaksiModel = new TransaksiModel();
        
        $totalBarang = $barangModel->countAllResults();
        $totalTransaksi = $transaksiModel->countAllResults();
        
        $transaksi = $transaksiModel->orderBy('created_at', 'DESC')->findAll();
        $pendapatan = 0;
        foreach($transaksi as $t) {
            $pendapatan += $t['total_harga'];
        }

        $transaksiDetailModel = new \App\Models\TransaksiDetailModel();
        $bestSellingProducts = $transaksiDetailModel->getBestSellingProducts(5);

        $data = [
            'view' => 'dashboard/index',
            'title' => 'Dashboard Kasir',
            'totalBarang' => $totalBarang,
            'totalTransaksi' => $totalTransaksi,
            'pendapatan' => $pendapatan,
            'transaksiList' => $transaksi,
            'bestSellingProducts' => $bestSellingProducts
        ];
        
        return view('layout', $data);
    }
}
