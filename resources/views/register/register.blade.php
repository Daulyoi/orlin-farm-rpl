<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Orlin Farm - Daftar</title>
  <link rel="stylesheet" href="/css/register/register.style.css">
</head>
<body>
  <x-header></x-header>

  <main class="form-container">
    <form class="register-box" action="{{ route('pelanggan.register') }}" method="POST">
      @csrf
      <!-- Nama Lengkap -->
      <div class="input-group">
        <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" class="icon-img" alt="user">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
      </div>

      <!-- Email -->
      <div class="input-group">
        <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" class="icon-img" alt="email">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <!-- Nomor Handphone -->
      <div class="input-group">
        <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" class="icon-img" alt="phone">
        <input type="text" name="no_telp" placeholder="Nomor Handphone" required>
      </div>

      <!-- Password -->
      <div class="input-group">
        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" class="icon-img" alt="lock">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <img src="/images/Hide.png" class="toggle-password" id="eye1" alt="eye" onclick="togglePassword('password', 'eye1')">
      </div>
      <small class="note">Ketentuan: 8-20 karakter. Mengandung huruf besar, huruf kecil, dan angka.</small>

      <!-- Konfirmasi Password -->
      <div class="input-group">
        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" class="icon-img" alt="lock">
        <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Konfirmasi Password" required>
        <img src="/images/Hide.png" class="toggle-password" id="eye2" alt="eye" onclick="togglePassword('confirmPassword', 'eye2')">
      </div>

      <button type="submit" class="submit-btn">Daftar</button>
      <p class="login-link">Sudah punya akun? <a href="{{ route('pelanggan.login') }}">Masuk</a></p>
    </form>
  </main>

  <!-- Script untuk ikon mata -->
  <script>
    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);

      if (input.type === "password") {
        input.type = "text";
        icon.src = "/images/See.png"; // ikon mata tertutup
        icon.alt = "Sembunyikan Password";
      } else {
        input.type = "password";
        icon.src = "/images/Hide.png"; // ikon mata terbuka
        icon.alt = "Lihat Password";
      }
    }
  </script>
</body>
</html>
