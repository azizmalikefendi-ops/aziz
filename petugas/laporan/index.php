<?php 
session_start();
include '../../main/connect.php';
if($_SESSION['status'] != "login") header("location:../../auth/login.php");

// Logika Filter Tanggal
$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : '';
$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : '';

// Query data
$where = "";
if($tgl_mulai != '' && $tgl_selesai != '') {
    $where = " WHERE TanggalPenjualan BETWEEN '$tgl_mulai 00:00:00' AND '$tgl_selesai 23:59:59'";
}
$summary = mysqli_query($conn, "SELECT SUM(TotalHarga) as total, COUNT(*) as jml FROM penjualan $where");
$ds = mysqli_fetch_assoc($summary);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - KASIR AZIZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #f5f7fa;
            color: #2d3748;
        }

        .container-fluid {
            padding: 1.5rem;
            max-width: 1400px;
        }

        /* Header */
        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #718096;
            font-size: 0.95rem;
        }

        .btn-print {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-print:hover {
            background: #5568d3;
            transform: translateY(-1px);
            color: white;
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
            outline: none;
        }

        .btn-filter {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-filter:hover {
            background: #5568d3;
        }

        .btn-reset {
            background: white;
            border: 1px solid #e2e8f0;
            color: #718096;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
        }

        /* Summary Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 600;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-icon.revenue {
            background: #f0fdf4;
            color: #48bb78;
        }

        .stat-icon.transaction {
            background: #e0e7ff;
            color: #1e3a8a;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a202c;
        }

        .stat-subtext {
            font-size: 0.85rem;
            color: #a0aec0;
            margin-top: 0.25rem;
        }

        /* Table Card */
        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-responsive {
            max-height: 600px;
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #f7fafc;
            padding: 1rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4a5568;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 2px solid #e2e8f0;
        }

        tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f7fafc;
        }

        tbody tr:hover {
            background: #f7fafc;
        }

        .row-number {
            font-weight: 600;
            color: #a0aec0;
        }

        .date-info {
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.25rem;
        }

        .time-info {
            font-size: 0.85rem;
            color: #718096;
        }

        .customer-name {
            font-weight: 600;
            color: #1a202c;
        }

        .price {
            font-weight: 700;
            font-size: 1.1rem;
            color: #48bb78;
        }

        /* Button Detail */
        .btn-detail {
            background: #e0e7ff;
            color: #1e3a8a;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            background: #1e3a8a;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: #718096;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #a0aec0;
        }

        /* Print Styles */
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            
            .table-card,
            .stat-card,
            .filter-card {
                box-shadow: none !important;
                border: 1px solid #e2e8f0 !important;
            }
            
            .print-header {
                display: block;
                text-align: center;
                padding: 2rem 0;
                border-bottom: 2px solid #1e3a8a;
                margin-bottom: 2rem;
            }

            .print-header h2 {
                font-size: 1.75rem;
                color: #1a202c;
                margin-bottom: 0.5rem;
            }

            .print-header p {
                color: #718096;
            }

            .print-footer {
                display: block;
                margin-top: 3rem;
                text-align: right;
                padding: 2rem;
            }

            .print-footer p {
                margin-bottom: 0.5rem;
            }

            .print-signature {
                margin-top: 3rem;
                font-weight: 700;
                color: #1a202c;
                border-top: 2px solid #1a202c;
                display: inline-block;
                padding-top: 0.5rem;
            }
        }

        .print-header,
        .print-footer {
            display: none;
        }

        /* Scrollbar */
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f7fafc;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 { font-size: 1.5rem; }
            .stats-grid { grid-template-columns: 1fr; }
            .stat-value { font-size: 1.5rem; }
            thead th, tbody td { padding: 0.75rem; font-size: 0.85rem; }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="no-print">
            <?php include '../../template/sidebar.php'; ?>
        </div>
        
        <div class="flex-fill">
            <div class="container-fluid">
                <!-- Header -->
                <div class="header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1><i class="fas fa-chart-line me-2"></i>Laporan Penjualan</h1>
                            <p>Analisis performa penjualan toko Anda</p>
                        </div>
                        <div class="col-md-6 text-end mt-3 mt-md-0">
                            <button class="btn-print no-print" onclick="window.print()">
                                <i class="fas fa-print me-2"></i>Cetak Laporan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter Card -->
                <div class="filter-card no-print">
                    <form method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-day me-2"></i>Dari Tanggal
                                </label>
                                <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-check me-2"></i>Sampai Tanggal
                                </label>
                                <input type="date" name="tgl_selesai" class="form-control" value="<?= $tgl_selesai ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label d-block">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn-filter">
                                        <i class="fas fa-filter me-2"></i>Filter
                                    </button>
                                    <a href="index.php" class="btn-reset">
                                        <i class="fas fa-sync-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-label">Total Pendapatan</span>
                            <div class="stat-icon revenue">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="stat-value">Rp <?= number_format($ds['total'] ?? 0, 0, ',', '.') ?></div>
                        <div class="stat-subtext">Omset periode ini</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-label">Total Transaksi</span>
                            <div class="stat-icon transaction">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="stat-value"><?= $ds['jml'] ?></div>
                        <div class="stat-subtext">Pesanan terlayani</div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-card">
                    <!-- Print Header -->
                    <div class="print-header">
                        <h2><i class="fas fa-store me-2"></i>LAPORAN PENJUALAN KASIR AZIZ</h2>
                        <p>Periode: <?= ($tgl_mulai ?: 'Semua Data') ?> s/d <?= ($tgl_selesai ?: 'Sekarang') ?></p>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th width="180">Waktu Transaksi</th>
                                    <th>Pelanggan</th>
                                    <th width="180" class="text-end">Total Bayar</th>
                                    <th width="120" class="text-center no-print">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM penjualan JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID $where ORDER BY TanggalPenjualan DESC");
                                
                                if(mysqli_num_rows($query) > 0) {
                                    while($d = mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                    <td class="row-number"><?= str_pad($no++, 2, "0", STR_PAD_LEFT) ?></td>
                                    <td>
                                        <div class="date-info"><?= date('d M Y', strtotime($d['TanggalPenjualan'])) ?></div>
                                        <div class="time-info">
                                            <i class="fas fa-clock me-1"></i><?= date('H:i', strtotime($d['TanggalPenjualan'])) ?> WIB
                                        </div>
                                    </td>
                                    <td>
                                        <div class="customer-name"><?= htmlspecialchars($d['NamaPelanggan']) ?></div>
                                    </td>
                                    <td class="text-end">
                                        <div class="price">Rp <?= number_format($d['TotalHarga'], 0, ',', '.') ?></div>
                                    </td>
                                    <td class="text-center no-print">
                                        <a href="detail.php?id=<?= $d['PenjualanID'] ?>" class="btn-detail">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                    } 
                                } else {
                                ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h4>Tidak Ada Data</h4>
                                            <p>Tidak ada transaksi pada periode yang dipilih</p>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Print Footer -->
                    <div class="print-footer">
                        <p style="color: #718096;">Dicetak pada: <strong><?= date('d/m/Y H:i') ?> WIB</strong></p>
                        <br><br><br>
                        <p class="print-signature">( ____________________ )</p>
                        <p style="color: #718096; font-weight: 600;">Admin KASIR AZIZ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>