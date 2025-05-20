<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <style>
    /* Reset dasar */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* ========== HEADER ========== */
  header {
    background-color: #009fe3; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    color: white;
  }

  /* === Logo Orlin Farm di kiri atas === */
  .logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: -20px;  /* jarak logo ke kiri */
  }

  .logo img {
    width: 40px;
    height: 40px;
  }

  .logo span {
    font-size: 20px;
    font-weight: bold; 
  }

/* === Menu Navigasi di kanan atas === */
nav ul {
  list-style: none;
  display: flex;
  gap: 30px;
  margin-right: -15px;
}

nav a {
  color: white;
  text-decoration: none;
  font-weight: normal;
  transition: 0.3s ease;
}

nav a:hover {
  text-decoration: underline;
}

/* ========== HERO SECTION ========== */
.hero {
  background-image: url('LandingPage.jpeg'); 
  background-size: cover;
  background-position: center;
  position: relative;
  min-height: 88.8vh; 
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

/* === Deskripsi Orlin Farm === */
.hero-content {
  background: rgba(255, 255, 255, 0); 
  color: #000;
  max-width: 900px;
  text-shadow: 0px 1px 2px rgba(255, 255, 255, 0.5); 
}

.hero h1 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 22px;
}

.hero p {
  font-size: 15px;
  font-weight: 500;
  line-height: 1.5;
  margin-bottom: 350px;
  text-align: center;
}
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="Logo Orlin Farm.png" alt="Logo Orlin Farm">
      <span>Orlin Farm</span>
    </div>
    <nav>
      <ul>
        <li><a href="#">Profil</a></li>
        <li><a href="#">Tabungan Qurban</a></li>
        <li><a href="#">Masuk</a></li>
        <li><a href="#">Daftar</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Deskripsi Orlin Farm</h1>
      <p>
        Orlin Farm adalah platform terpercaya untuk jual beli hewan qurban secara online yang melayani wilayah Jabodetabek. 
        Kami menyediakan hewan qurban berkualitas, layanan tabungan qurban, serta kemudahan transaksi digital. Dengan semangat 
        transparansi dan amanah, Orlin Farm hadir untuk memudahkan ibadah qurban Anda secara praktis dan tepat sasaran.
      </p>
    </div>
  </section>

  	@include('landingpage.etalase')

</body>
</html>
