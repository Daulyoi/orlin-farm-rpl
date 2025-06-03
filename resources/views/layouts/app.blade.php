<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Orlin Farm')</title>
    <meta name="description" content="Orlin Farm - Peternakan Kambing Terpercaya di Indonesia">
    <meta name="keywords" content="peternakan, kambing, orlin farm, ternak kambing, jual kambing">
    <link rel="icon" href="{{ asset('images/OrlinFarm.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    @stack('styles')
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body>
    <x-header></x-header>
    
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>