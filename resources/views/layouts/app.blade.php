<!DOCTYPE html>
<html lang="id">
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const loader = document.getElementById('page-loader');

        if (!loader) return;

        function showLoader() {
            loader.classList.remove('hidden');
            loader.classList.add('flex');
        }

        function hideLoader() {
            loader.classList.add('hidden');
            loader.classList.remove('flex');
        }

        // Pastikan loader hilang setelah halaman selesai tampil
        window.addEventListener('pageshow', function () {
            hideLoader();
        });

        // Link navigation
        document.addEventListener('click', function (event) {

            const link = event.target.closest('a');

            if (!link) return;

            const href = link.getAttribute('href');

            // Abaikan link yang tidak melakukan navigasi halaman
            if (
                !href ||
                href === '#' ||
                href.startsWith('#') ||
                href.startsWith('javascript:') ||
                link.hasAttribute('download') ||
                link.target === '_blank'
            ) {
                return;
            }

            // Abaikan modifier key: Ctrl+Click, Shift+Click, dll.
            if (
                event.ctrlKey ||
                event.metaKey ||
                event.shiftKey ||
                event.altKey
            ) {
                return;
            }

            // Hanya URL pada website yang sama
            try {

                const url = new URL(link.href, window.location.href);

                if (url.origin !== window.location.origin) {
                    return;
                }

                if (
                url.pathname === window.location.pathname &&
                url.search === window.location.search &&
                !url.hash
            ) {
                return;
            }

            } catch (error) {
                return;
            }

            showLoader();
        });


        // Form submit
        document.addEventListener('submit', function () {
            showLoader();
        });

    });
</script>
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

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col justify-between">

    @include('partials.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

</body>

{{-- Global Page Loader --}}
<div
    id="page-loader"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/40 backdrop-blur-md transition-opacity duration-300"
>
    <div class="flex flex-col items-center bg-white/95 px-8 py-6 rounded-2xl shadow-2xl border border-white/50">

        <div class="relative flex h-16 w-16 items-center justify-center">

            <div class="absolute inset-0 animate-spin rounded-full
                        border-4 border-slate-100
                        border-t-blue-600">
            </div>

            <img
                src="{{ asset('images/logo.png') }}"
                alt="DIGILIB STKIP"
                class="h-9 w-9 object-contain"
            >

        </div>

        <p class="mt-4 font-bold text-slate-800 tracking-tight">
            DIGILIB STKIP
        </p>

        <p class="mt-1 text-xs text-slate-500 font-medium">
            Memuat halaman...
        </p>

    </div>
</div>

</html>