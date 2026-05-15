<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Daftar Barang</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
            + Tambah Barang
        </button>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table id="tabelBarang" class="table table-striped table-hover rounded" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahBarangModalLabel">Tambah Barang Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('barang/store') ?>" method="post">
          <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= old('nama_barang') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required onchange="handleKategoriChange(this)">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($kategoriList as $k): ?>
                            <?php if(!empty($k['kategori'])): ?>
                                <option value="<?= esc($k['kategori']) ?>"><?= esc($k['kategori']) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <option value="NEW_KATEGORI" class="text-primary fw-bold">+ Tambah Kategori Baru</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah / Stok</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" required min="0">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Satuan (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= old('harga') ?>" required min="0">
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#tabelBarang').DataTable({
        "ajax": {
            "url": "<?= base_url('barang/getData') ?>",
            "type": "GET"
        },
        "columns": [
            { 
                "data": null, 
                "sortable": false, 
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "nama_barang" },
            { "data": "kategori" },
            { "data": "jumlah" },
            { 
                "data": "harga",
                "render": function(data, type, row) {
                    return 'Rp ' + Number(data).toLocaleString('id-ID');
                }
            },
            {
                "data": "id",
                "className": "text-center",
                "sortable": false,
                "render": function(data, type, row) {
                    return `
                        <a href="<?= base_url('barang/edit/') ?>${data}" class="btn btn-warning btn-sm text-white">Edit</a>
                        <button onclick="deleteBarang(${data})" class="btn btn-danger btn-sm">Hapus</button>
                    `;
                }
            }
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
        }
    });
    
    <?php if (session()->getFlashdata('errors')) : ?>
        var myModal = new bootstrap.Modal(document.getElementById('tambahBarangModal'));
        myModal.show();
    <?php endif; ?>
});

function deleteBarang(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: "<?= base_url('barang/delete/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(response) {
                $('#tabelBarang').DataTable().ajax.reload();
            },
            error: function(xhr) {
                alert('Gagal menghapus data!');
            }
        });
    }
}

function handleKategoriChange(selectObject) {
    var value = selectObject.value;  
    if(value === 'NEW_KATEGORI') {
        var newCategory = prompt("Masukkan Kategori Baru:");
        if (newCategory) {
            newCategory = newCategory.trim();
            if (newCategory.length > 0) {
                var newOption = new Option(newCategory, newCategory, true, true);
                
                var lastIndex = selectObject.options.length - 1;
                selectObject.add(newOption, selectObject.options[lastIndex]);
                
                selectObject.value = newCategory;
            } else {
                selectObject.selectedIndex = 0;
            }
        } else {
            selectObject.selectedIndex = 0;
        }
    }
}
</script>
