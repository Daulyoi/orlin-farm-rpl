<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="RiwayatPemesanan.css">
    <title>Riwayat Pemesanan</title>
    <link rel="stylesheet" href="/css/profiluser/riwayatpesanan.style.css">
</head>
<body>
    <x-header></x-header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <button class="sidebar-button">Profil</button>
            <button class="sidebar-button active">Riwayat Pemesanan</button>
        </aside>

        <!-- Vertical Divider -->
        <div class="vertical-divider"></div>

        <!-- Riwayat Pemesanan Section -->
        <section class="riwayat-section">
            <h1>Riwayat Pemesanan</h1>
            <div class="search-container">
                <button class="filter-button">
                    <img src="filter.png" alt="Filter">
                </button>
                <button class="sort-button">
                    <img src="sort.png" alt="Sort">
                </button>
                <input type="text" placeholder="Search Here">
                <button class="search-button">
                    <img src="search-removebg-preview.png" alt="Search">
                </button>
            </div>
            <div class="order-list">
                <div class="order-item">
                    <span class="order-date">26 Februari 2025</span>
                    <span class="order-detail">2 Kambing</span>
                    <span class="order-price">Rp.4.000.000,00</span>
                    <span class="order-status pending">Menunggu Verifikasi</span>
                    <button class="edit-button">
                        <img src="expand-removebg-preview.png" alt="Expand">
                    </button>
                </div>
                <div class="order-item">
                    <span class="order-date">1 Agustus 2024</span>
                    <span class="order-detail">2 Kambing</span>
                    <span class="order-price">Rp.4.000.000,00</span>
                    <span class="order-status verified">Telah Diverifikasi</span>
                    <button class="edit-button">
                        <img src="expand-removebg-preview.png" alt="Expand">
                    </button>
                </div>
                <div class="order-item">
                    <span class="order-date">23 Mei 2024</span>
                    <span class="order-detail">3 Kambing</span>
                    <span class="order-price">Rp.6.000.000,00</span>
                    <span class="order-status verified">Telah Diverifikasi</span>
                    <button class="edit-button">
                        <img src="expand-removebg-preview.png" alt="Expand">
                    </button>
                </div>
                <div class="order-item">
                    <span class="order-date">15 Maret 2024</span>
                    <span class="order-detail">1 Sapi & 2 Kambing</span>
                    <span class="order-price">Rp.9.000.000,00</span>
                    <span class="order-status verified">Telah Diverifikasi</span>
                    <button class="edit-button">
                        <img src="expand-removebg-preview.png" alt="Expand">
                    </button>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
