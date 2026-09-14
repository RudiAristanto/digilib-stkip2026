<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'DIGILIB STKIP')
    </title>

    {{-- Favicon --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo.png') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/logo-stkip.png') }}"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-50 text-gray-800">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>