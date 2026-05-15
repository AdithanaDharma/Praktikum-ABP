<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Total Barang</h5>
                <h2 class="mb-0"><?= esc($totalBarang) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Total Transaksi</h5>
                <h2 class="mb-0"><?= esc($totalTransaksi) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <h5 class="card-title">Total Pendapatan</h5>
                <h2 class="mb-0">Rp <?= number_format($pendapatan, 0, ',', '.') ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                <a href="<?= base_url('kasir') ?>" class="btn btn-sm btn-primary">Tambah Transaksi</a>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTableTransaksi" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksiList as $row) : ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('transaksi/detail/' . $row['id']) ?>" class="btn btn-success btn-sm">Detail</a>
                                        <a href="<?= base_url('transaksi/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="<?= base_url('transaksi/delete/' . $row['id']) ?>" method="post" class="d-inline">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Detail barang juga akan terhapus.');">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">5 Produk Terlaris</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>Peringkat</th>
                                <th>Nama Barang</th>
                                <th>Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $peringkat = 1; ?>
                            <?php foreach ($bestSellingProducts as $product): ?>
                                <tr>
                                    <td>
                                        <?= $peringkat ?>
                                    </td>
                                    <td><?= esc($product['nama_barang']) ?></td>
                                    <td><span class="badge bg-success"><?= esc($product['total_terjual']) ?> Item</span></td>
                                </tr>
                                <?php $peringkat++; ?>
                            <?php endforeach; ?>
                            <?php if(empty($bestSellingProducts)): ?>
                                <tr>
                                    <td colspan="3">Belum ada data penjualan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
    $(document).ready(function() {
        $('#dataTableTransaksi').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
