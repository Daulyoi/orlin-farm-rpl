<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Register Admin</h1>
    <form action="{{ route('admin.register') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <a href="{{ route('admin.login') }}">ke laman login</a>

    @error('password')
        <div style="color: red;">
            {{ $message }}
        </div>
    @enderror

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
</body>
</html>

