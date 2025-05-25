<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orlin Farm - Login</title>
  <link rel="stylesheet" href="/css/login/login.style.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="/images/OrlinFarm.png">
      Orlin Farm
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
        <img class="icon" src="https://cdn-icons-png.flaticon.com/512/561/561127.png" width="20">
        <input type="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <img class="icon" src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" alt="Password Icon" width="20">
        <input type="password" id="password" placeholder="Password" required>
        <img
          id="eyeIcon"
          class="toggle-password"
          src="/images/Hide.png"
          alt="Eye Icon"
          width="20"
          onclick="togglePassword()"
          style="cursor: pointer;"
        >
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox"> Ingat Saya</label>
        <a href="#">Lupa Password?</a>
      </div>
      <button type="submit">Masuk</button>
      <p class="register-link">Belum punya akun? <a href="Register.html">Daftar</a></p>
    </form>
  </main>

  <!-- ✅ Script Toggle Password -->
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const eyeIcon = document.getElementById("eyeIcon");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = "/images/See.png"; // ikon mata tertutup
      } else {
        passwordInput.type = "password";
        eyeIcon.src = "/images/Hide.png"; // ikon mata terbuka
      }
    }
  </script>
</body>
</html>
