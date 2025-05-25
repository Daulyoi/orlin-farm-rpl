<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="RiwayatPemesanan.css">
    <title>Riwayat Pemesanan</title>
    <style>
        /* Global Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Header */
    header {
        background-color: #009fe3; /* Warna biru header */
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        color: white;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo img {
        width: 40px;
        height: 40px;
    }

    .logo span {
        font-size: 20px;
        font-weight: bold; 
    }

    nav a {
        color: white;
        text-decoration: none;
        margin-right: 20px;
    }

    /* Main Container */
    .main-container {
        display: flex;
        margin: 20px;
        gap: 20px;
    }

    /* Sidebar */
    .sidebar {
        width: 20%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .sidebar-button {
        background-color: #f9f9f9; /* Warna latar tombol sidebar */
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
        cursor: pointer;
        font-size: 16px;
        border-radius: 4px;
    }

    .sidebar-button.active {
        background-color: #009fe3; /* Warna tombol aktif */
        color: white;
    }

    .sidebar-button:hover {
        background-color: #e0e0e0; /* Warna hover tombol sidebar */
    }

    /* Vertical Divider */
    .vertical-divider {
        width: 1px;
        background-color: #000; /* Warna garis pemisah */
        height: auto;
    }

    /* Riwayat Pemesanan Section */
    .riwayat-section {
        width: 75%;
    }

    .riwayat-section h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .search-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        justify-content: flex-end;
    }

    .search-container input {
        flex: 1;
        max-width: 300px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-button, .filter-button, .sort-button {
        background-color: white;
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-button img, .filter-button img, .sort-button img {
        width: 16px;
        height: 16px;
    }

    .order-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .order-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    .order-date, .order-detail, .order-price, .order-status {
        flex: 1;
        font-size: 14px;
    }

    .order-status {
        text-align: center;
        padding: 5px;
        border-radius: 4px;
        font-size: 12px;
    }

    .order-status.pending {
        background-color: #ffc107; /* Kuning untuk status pending */
        color: #fff;
    }

    .order-status.verified {
        background-color: #28a745; /* Hijau untuk status verified */
        color: #fff;
    }

    .edit-button {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        margin-left: 15px;
    }

    .edit-button img {
        width: 16px;
        height: 16px;
    }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="Logo Orlin Farm.png" alt="Logo Orlin Farm">
            <span>Orlin Farm</span>
        </div>
        <nav>
            <a href="#">Profil</a>
            <a href="#">Masuk</a>
            <a href="#">Daftar</a>
        </nav>
    </header>
    
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