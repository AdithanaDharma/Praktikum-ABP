<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi #<?= esc($transaksi['id']) ?></h6>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th width="30%">ID Transaksi</th>
                        <td>: <?= esc($transaksi['id']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: <?= date('d-m-Y H:i:s', strtotime($transaksi['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <th>Total Belanja</th>
                        <td>: Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <h5 class="mb-3">Item Pembelian</h5>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($details as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($item['barang_id']) ?></td>
                        <td><?= esc($item['nama_barang']) ?></td>
                        <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                        <td><?= esc($item['jumlah']) ?></td>
                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($details)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada detail barang untuk transaksi ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total Harga</th>
                        <th>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
