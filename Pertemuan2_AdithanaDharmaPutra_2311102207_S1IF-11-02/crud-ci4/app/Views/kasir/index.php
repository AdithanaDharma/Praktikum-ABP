<div class="row">
    <div class="col-md-7">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Pilih Barang</h5>
            </div>
            <div class="card-body">
                <input type="text" id="searchBarang" class="form-control mb-3" placeholder="Ketik nama atau ID barang..." autocomplete="off">
                <div class="list-group" id="searchResult" style="max-height: 480px; overflow-y: auto;">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Keranjang Belanja</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm" id="cartTable">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th width="80">Harga</th>
                            <th width="80" class="text-center">Qty</th>
                            <th width="80" class="text-end">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="5" class="text-center text-muted">Keranjang kosong</td></tr>
                    </tbody>
                </table>
                <hr>
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <h5 class="mb-0">Total:</h5>
                    <h4 class="mb-0 text-success fw-bold" id="grandTotal">Rp 0</h4>
                </div>
                <button class="btn btn-primary w-100 btn-lg shadow" id="btnCheckout" disabled>Proses Pembayaran</button>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];

$(document).ready(function() {
    function searchItems(query = '') {
        $.ajax({
            url: "<?= base_url('kasir/getBarang') ?>",
            type: "GET",
            data: { q: query },
            dataType: "JSON",
            success: function(data) {
                let html = '';
                if(data.length > 0) {
                    data.forEach(function(item) {
                        html += `
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 border-bottom mb-1" onclick="addToCart(${item.id}, '${item.nama_barang}', ${item.harga}, ${item.jumlah})">
                            <div>
                                <h6 class="mb-0 fw-bold">${item.nama_barang}</h6>
                                <small class="text-muted">Stok: ${item.jumlah}</small>
                            </div>
                            <span class="fw-bold text-dark" style="font-size:0.95rem;">Rp ${Number(item.harga).toLocaleString('id-ID')}</span>
                        </a>`;
                    });
                } else {
                    html = '<div class="list-group-item text-center text-muted border-0">Barang tidak ditemukan atau stok kosong</div>';
                }
                $('#searchResult').html(html);
            }
        });
    }

    searchItems();

    $('#searchBarang').on('keyup', function() {
        searchItems($(this).val());
    });

    $('#btnCheckout').click(function() {
        if (cart.length === 0) return;
        
        let confirmBtn = $(this);
        confirmBtn.prop('disabled', true).text('Memproses...');
        
        $.ajax({
            url: "<?= base_url('kasir/processTransaction') ?>",
            type: "POST",
            data: JSON.stringify(cart),
            contentType: "application/json",
            dataType: "JSON",
            success: function(res) {
                alert(res.message);
                cart = [];
                renderCart();
                searchItems(); 
                confirmBtn.text('Proses Pembayaran');
            },
            error: function(err) {
                alert(err.responseJSON?.messages?.error || 'Terjadi kesalahan sistem');
                confirmBtn.prop('disabled', false).text('Proses Pembayaran');
            }
        });
    });
});

function addToCart(id, nama, harga, stok) {
    let existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        if (existingItem.qty < stok) {
            existingItem.qty++;
        } else {
            alert('Melebihi stok yang tersedia!');
        }
    } else {
        cart.push({ id: id, nama: nama, harga: harga, qty: 1, stok: stok });
    }
    renderCart();
}

function updateQty(id, change) {
    let item = cart.find(item => item.id === id);
    if (item) {
        let newQty = item.qty + change;
        if (newQty > 0 && newQty <= item.stok) {
            item.qty = newQty;
        } else if (newQty > item.stok) {
            alert('Melebihi stok yang tersedia!');
        } else if (newQty === 0) {
            removeItem(id);
            return;
        }
    }
    renderCart();
}

function removeItem(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
}

function renderCart() {
    let html = '';
    let total = 0;
    cart.forEach(item => {
        let subtotal = item.qty * item.harga;
        total += subtotal;
        html += `
        <tr class="align-middle">
            <td style="font-size:13px;" class="fw-semibold">${item.nama}</td>
            <td style="font-size:13px;">${Number(item.harga).toLocaleString('id-ID')}</td>
            <td>
                <div class="input-group input-group-sm" style="width: 80px; margin: 0 auto;">
                    <button class="btn btn-outline-secondary px-2" onclick="updateQty(${item.id}, -1)">-</button>
                    <input type="text" class="form-control text-center px-1" value="${item.qty}" readonly>
                    <button class="btn btn-outline-secondary px-2" onclick="updateQty(${item.id}, 1)">+</button>
                </div>
            </td>
            <td style="font-size:13px;" class="text-end fw-semibold">${Number(subtotal).toLocaleString('id-ID')}</td>
            <td class="text-end"><button class="btn btn-danger btn-sm px-2 text-white shadow-sm" onclick="removeItem(${item.id})">&times;</button></td>
        </tr>`;
    });
    
    if (cart.length > 0) {
        $('#cartTable tbody').html(html);
        $('#btnCheckout').prop('disabled', false);
    } else {
        $('#cartTable tbody').html('<tr><td colspan="5" class="text-center text-muted">Keranjang kosong</td></tr>');
        $('#btnCheckout').prop('disabled', true);
    }
    $('#grandTotal').text('Rp ' + Number(total).toLocaleString('id-ID'));
}
</script>
