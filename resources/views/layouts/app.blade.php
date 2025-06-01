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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=lock" />
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