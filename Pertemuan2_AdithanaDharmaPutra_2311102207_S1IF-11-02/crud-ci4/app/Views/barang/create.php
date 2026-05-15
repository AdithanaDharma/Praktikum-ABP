<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Tambah Data Barang</h5>
    </div>
    <div class="card-body">
        
        <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('barang/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= old('nama_barang') ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori') ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= old('harga') ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Simpan Data</button>
            <a href="<?= base_url('barang') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
