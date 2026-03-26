<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table            = 'transaksi_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['transaksi_id', 'barang_id', 'jumlah', 'harga_satuan', 'subtotal'];
    protected $useTimestamps = false;

    public function getBestSellingProducts($limit = 5)
    {
        return $this->select('barang.nama_barang, SUM(transaksi_detail.jumlah) as total_terjual')
                    ->join('barang', 'barang.id = transaksi_detail.barang_id')
                    ->groupBy('transaksi_detail.barang_id')
                    ->orderBy('total_terjual', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
