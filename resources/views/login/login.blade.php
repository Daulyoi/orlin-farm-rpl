<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orlin Farm - Login</title>
  <link rel="stylesheet" href="Login.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="OrlinFarm.png">
    </div>
    <nav>
      <a href="#">Profil</a>
      <a href="#">Tabungan Qurban</a>
      <a href="Login.html">Masuk</a>
      <a href="Register.html">Daftar</a>
    </nav>
  </header>

  <main>
    <form class="login-box">
      <div class="input-group">
        <img class="icon" src="https://cdn-icons-png.flaticon.com/512/561/561127.png"width="20">
        <input type="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <img class="icon" src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" alt="Password Icon" width="20">
        <input type="password" placeholder="Password" required>
        <img class="toggle-password" src="https://cdn-icons-png.flaticon.com/512/709/709612.png" alt="Eye Icon" width="20">
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox"> Ingat Saya</label>
        <a href="#">Lupa Password?</a>
      </div>
      <button type="submit">Masuk</button>
      <p class="register-link">Belum punya akun? <a href="Register.html">Daftar</a></p>
    </form>
  </main>
</body>
</html>
