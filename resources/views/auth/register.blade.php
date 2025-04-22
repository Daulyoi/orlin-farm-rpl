<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('pelanggan.register') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <input type="text" name="alamat" placeholder="alamat">
        <button type="submit">Register</button>
    </form>
    <a href="{{ route('pelanggan.login') }}">ke laman login</a>
</body>
</html>

