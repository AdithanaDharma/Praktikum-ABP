<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi #<?= esc($transaksi['id']) ?></h6>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('transaksi/update/' . $transaksi['id']) ?>" method="post">
            <div class="mb-4">
                <label for="created_at" class="form-label font-weight-bold">Tanggal Transaksi</label>
                <input type="datetime-local" class="form-control w-25" id="created_at" name="created_at" value="<?= date('Y-m-d\TH:i', strtotime($transaksi['created_at'])) ?>" required>
            </div>
            
            <hr>
            <h6 class="font-weight-bold mb-3">Item Pembelian</h6>
            
            <div class="table-responsive mb-4">
                <table class="table table-bordered" id="itemTable">
                    <thead class="table-light">
                        <tr>
                            <th width="40%">Pilih Barang</th>
                            <th width="20%">Harga Satuan</th>
                            <th width="15%">Qty</th>
                            <th width="20%">Subtotal</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($details as $index => $item): ?>
                        <tr>
                            <td>
                                <select class="form-select barang-select" name="barang_id[]" required onchange="updateRow(this)">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach($semuaBarang as $b): ?>
                                        <option value="<?= $b['id'] ?>" data-harga="<?= $b['harga'] ?>" <?= ($b['id'] == $item['barang_id']) ? 'selected' : '' ?>>
                                            <?= esc($b['nama_barang']) ?> (Stok Tersedia: <?= $b['jumlah'] ?> + <?= ($b['id'] == $item['barang_id']) ? $item['jumlah'] : 0 ?> di Trx ini)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control harga-satuan" value="<?= number_format($item['harga_satuan'], 0, ',', '.') ?>" readonly>
                                </div>
                            </td>
                            <td>
                                <input type="number" class="form-control qty-input" name="qty[]" value="<?= $item['jumlah'] ?>" min="1" required onchange="updateRow(this); updateGrandTotal();">
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control subtotal-input" value="<?= number_format($item['subtotal'], 0, ',', '.') ?>" readonly>
                                </div>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removeRow(this)"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <button type="button" class="btn btn-success btn-sm" onclick="addRow()"><i class="fas fa-plus"></i> Tambah Item</button>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end h5 border-0 mt-3 d-inline-block">Total Harga Transaksi Baru:</th>
                            <th colspan="2" class="h5 border-0 mt-3" id="grandTotalLabel">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi</button>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    function updateRow(element) {
        let row = $(element).closest('tr');
        let select = row.find('.barang-select option:selected');
        let harga = select.data('harga') || 0;
        let qty = row.find('.qty-input').val() || 0;
        let subtotal = harga * qty;
        
        row.find('.harga-satuan').val(formatRupiah(harga));
        row.find('.subtotal-input').val(formatRupiah(subtotal));
        
        updateGrandTotal();
    }

    function updateGrandTotal() {
        let grandTotal = 0;
        $('#itemTable tbody tr').each(function() {
            let select = $(this).find('.barang-select option:selected');
            let harga = select.data('harga') || 0;
            let qty = $(this).find('.qty-input').val() || 0;
            grandTotal += (harga * qty);
        });
        $('#grandTotalLabel').text('Rp ' + formatRupiah(grandTotal));
    }

    function addRow() {
        let newRow = `
        <tr>
            <td>
                <select class="form-select barang-select" name="barang_id[]" required onchange="updateRow(this)">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach($semuaBarang as $b): ?>
                        <option value="<?= $b['id'] ?>" data-harga="<?= $b['harga'] ?>">
                            <?= esc($b['nama_barang']) ?> (Stok Tersedia: <?= $b['jumlah'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control harga-satuan" value="0" readonly>
                </div>
            </td>
            <td>
                <input type="number" class="form-control qty-input" name="qty[]" value="1" min="1" required onchange="updateRow(this); updateGrandTotal();">
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control subtotal-input" value="0" readonly>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm mt-1" onclick="removeRow(this)"><i class="fas fa-trash"></i></button>
            </td>
        </tr>`;
        $('#itemTable tbody').append(newRow);
    }

    function removeRow(btn) {
        $(btn).closest('tr').remove();
        updateGrandTotal();
    }
    
    $(document).ready(function() {
        // Initialize Grand Total on load
        updateGrandTotal();
    });
</script>
