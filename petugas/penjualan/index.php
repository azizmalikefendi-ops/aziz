<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");

$current_dir = 'transaksi'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - KASIR AZIZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Header */
        .header-section {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }

        /* Search */
        .search-box {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            width: 100%;
            transition: all 0.2s;
        }

        .search-box:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        /* Products */
        .products-grid {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        .products-grid::-webkit-scrollbar {
            width: 6px;
        }

        .products-grid::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .products-grid::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .product-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            height: 100%;
        }

        .product-card:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .product-id {
            background: #f1f5f9;
            color: #64748b;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .product-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .product-price {
            font-size: 1.125rem;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 0.75rem;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stock-info {
            background: #dcfce7;
            color: #16a34a;
            padding: 0.25rem 0.625rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .add-icon {
            width: 32px;
            height: 32px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
        }

        /* Cart */
        .cart-container {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            position: sticky;
            top: 1.5rem;
            max-height: calc(100vh - 3rem);
            display: flex;
            flex-direction: column;
        }

        .cart-header {
            background: #3b82f6;
            color: white;
            padding: 1.25rem;
            border-radius: 12px 12px 0 0;
            font-weight: 700;
            font-size: 1rem;
        }

        .cart-body {
            padding: 1.25rem;
            flex: 1;
            overflow-y: auto;
        }

        /* Customer Form */
        .customer-form {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .form-input {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            width: 100%;
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
        }

        /* Cart Table */
        .cart-items {
            max-height: 250px;
            overflow-y: auto;
            margin-bottom: 1rem;
        }

        .cart-items::-webkit-scrollbar {
            width: 5px;
        }

        .cart-items::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .cart-items::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .item-price {
            color: #64748b;
            font-size: 0.75rem;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.25rem;
            font-weight: 600;
            margin: 0 0.75rem;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            padding: 0.5rem;
        }

        .delete-btn:hover {
            color: #dc2626;
        }

        /* Empty State */
        .empty-cart {
            text-align: center;
            padding: 2rem 1rem;
            color: #94a3b8;
        }

        .empty-cart i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            opacity: 0.3;
        }

        /* Total Section */
        .total-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .total-label {
            font-weight: 600;
            color: #64748b;
            font-size: 0.875rem;
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .payment-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1.125rem;
            font-weight: 600;
            color: #10b981;
            margin-bottom: 0.75rem;
        }

        .payment-input:focus {
            outline: none;
            border-color: #10b981;
        }

        .change-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .change-amount {
            font-size: 1.125rem;
            font-weight: 700;
            color: #ef4444;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 0.875rem;
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .submit-btn:hover:not(:disabled) {
            background: #2563eb;
        }

        .submit-btn:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-container {
                position: relative;
                top: 0;
                margin-top: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include '../../template/sidebar.php'; ?>
        
        <div class="container-fluid p-4">
            <!-- Header -->
            <div class="header-section">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="page-title">
                                <i class="fas fa-shopping-bag me-2"></i>
                                Transaksi Penjualan
                            </h1>
                            <p class="page-subtitle mt-1">Pilih produk untuk ditambahkan ke keranjang</p>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <div class="search-wrapper">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="searchInput" class="search-box" placeholder="Cari produk..." onkeyup="cariProduk()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <!-- Products -->
                <div class="col-lg-7">
                    <div class="products-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM produk WHERE Stok > 0 ORDER BY NamaProduk ASC");
                        while($p = mysqli_fetch_array($sql)){
                        ?>
                        <div class="col">
                            <div class="product-card" onclick="tambahItem('<?= $p['ProdukID'] ?>', '<?= addslashes($p['NamaProduk']) ?>', '<?= $p['Harga'] ?>', '<?= $p['Stok'] ?>')">
                                <span class="product-id">#<?= $p['ProdukID'] ?></span>
                                <div class="product-name"><?= $p['NamaProduk'] ?></div>
                                <div class="product-price">Rp <?= number_format($p['Harga'], 0, ',', '.') ?></div>
                                <div class="product-footer">
                                    <span class="stock-info">
                                        <i class="fas fa-box me-1"></i><?= $p['Stok'] ?>
                                    </span>
                                    <div class="add-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Cart -->
                <div class="col-lg-5">
                    <div class="cart-container">
                        <div class="cart-header">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Keranjang Belanja
                        </div>
                        
                        <div class="cart-body">
                            <form action="proses_simpan.php" method="POST" id="formTransaksi">
                                <!-- Customer Info -->
                                <div class="customer-form">
                                    <div class="mb-2">
                                        <input type="text" name="NamaPelanggan" class="form-input" placeholder="Nama Pelanggan" required>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="text" name="NomorTelepon" class="form-input" placeholder="No. Telepon" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="Alamat" class="form-input" placeholder="Alamat" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cart Items -->
                                <div class="cart-items" id="cartItems">
                                    <div class="empty-cart">
                                        <i class="fas fa-shopping-basket"></i>
                                        <div class="mt-2">Keranjang kosong</div>
                                        <small>Pilih produk untuk memulai</small>
                                    </div>
                                </div>

                                <!-- Total -->
                                <div class="total-section">
                                    <div class="total-row">
                                        <span class="total-label">Total</span>
                                        <div class="total-amount" id="totalHarga">Rp 0</div>
                                    </div>
                                    <input type="number" id="uangBayar" name="Bayar" class="payment-input" placeholder="Uang Bayar" oninput="hitungKembalian()">
                                    <div class="change-row">
                                        <span class="total-label">Kembalian</span>
                                        <span class="change-amount" id="textKembalian">Rp 0</span>
                                    </div>
                                </div>
                                
                                <button type="submit" class="submit-btn" id="btnBayar" disabled>
                                    <i class="fas fa-check me-2"></i>
                                    Proses Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let items = [];

        function tambahItem(id, nama, harga, stokMax) {
            let index = items.findIndex(i => i.id === id);
            
            if(index !== -1) {
                if(items[index].qty < stokMax) {
                    items[index].qty++;
                    showToast('Jumlah ditambahkan', 'success');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Terbatas',
                        text: `Maksimal stok: ${stokMax}`,
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }
            } else {
                items.push({ id, nama, harga: parseInt(harga), qty: 1 });
                showToast('Produk ditambahkan', 'success');
            }
            renderCart();
        }

        function hapusItem(index) {
            items.splice(index, 1);
            renderCart();
            showToast('Item dihapus', 'info');
        }

        function renderCart() {
            let html = '';
            let total = 0;
            
            items.forEach((item, i) => {
                let subtotal = item.qty * item.harga;
                total += subtotal;
                html += `
                <div class="cart-item">
                    <div class="item-info">
                        <div class="item-name">${item.nama}</div>
                        <div class="item-price">Rp ${item.harga.toLocaleString('id-ID')}</div>
                        <input type="hidden" name="ProdukID[]" value="${item.id}">
                    </div>
                    <input type="number" name="Jumlah[]" class="qty-input" value="${item.qty}" readonly>
                    <div style="min-width: 80px; text-align: right; font-weight: 600;">
                        Rp ${subtotal.toLocaleString('id-ID')}
                    </div>
                    <button type="button" class="delete-btn" onclick="hapusItem(${i})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>`;
            });
            
            if(items.length === 0) {
                html = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-basket"></i>
                    <div class="mt-2">Keranjang kosong</div>
                    <small>Pilih produk untuk memulai</small>
                </div>`;
            }

            document.getElementById('cartItems').innerHTML = html;
            document.getElementById('totalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');
            hitungKembalian();
        }

        function hitungKembalian() {
            let total = items.reduce((sum, item) => sum + (item.qty * item.harga), 0);
            let bayar = parseInt(document.getElementById('uangBayar').value) || 0;
            let kembalian = bayar - total;
            
            document.getElementById('textKembalian').innerText = 'Rp ' + (kembalian >= 0 ? kembalian.toLocaleString('id-ID') : 0);
            document.getElementById('btnBayar').disabled = (items.length === 0 || kembalian < 0 || bayar === 0);
        }

        function cariProduk() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.querySelectorAll('.product-card');

            cards.forEach(card => {
                let nama = card.querySelector('.product-name').innerText.toLowerCase();
                card.closest('.col').style.display = nama.includes(input) ? '' : 'none';
            });
        }

        function showToast(message, icon) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            Toast.fire({ icon, title: message });
        }

        document.getElementById('formTransaksi').addEventListener('submit', function(e) {
            if(items.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Keranjang Kosong',
                    text: 'Tambahkan produk terlebih dahulu'
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>