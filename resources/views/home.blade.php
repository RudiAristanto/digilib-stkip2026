@extends('layouts.app')

@section('title', 'DIGILIB STKIP')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-gradient-to-r from-blue-800 via-blue-700 to-sky-600">

    <div class="max-w-7xl mx-auto px-6 py-24">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- LEFT --}}
            <div>

                <span
                    class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 text-white text-sm">

                    Digital Repository STKIP

                </span>

                <h1 class="mt-6 text-5xl font-bold leading-tight text-white">

                    Temukan Ribuan
                    <span class="text-yellow-300">
                        Karya Ilmiah
                    </span>
                    dengan Mudah

                </h1>

                <p class="mt-6 text-lg text-blue-100 leading-8">

                    DIGILIB STKIP merupakan perpustakaan digital
                    yang menyediakan skripsi, jurnal, buku,
                    prosiding, artikel ilmiah dan berbagai dokumen
                    akademik lainnya.

                </p>
                
                @if($userGuides->count())

                @php
                    $guide = $userGuides->first();
                @endphp

                <div
                    class="mt-8 flex flex-col gap-3 rounded-xl border border-white/20
                        bg-white/10 px-4 py-3 backdrop-blur-sm
                        sm:flex-row sm:items-center sm:justify-between"
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center
                                rounded-lg bg-white/20 text-white"
                        >
                            <x-heroicon-o-book-open class="h-5 w-5" />
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-white">
                                {{ $guide->judul }}
                            </p>

                            <p class="text-xs text-blue-100">
                                Petunjuk penggunaan DIGILIB STKIP
                            </p>

                        </div>

                    </div>

                    <div class="flex items-center gap-2">

                        <a
                            href="{{ asset('storage/' . $guide->file) }}"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 rounded-lg
                                bg-white px-3 py-2 text-xs font-semibold
                                text-blue-700 transition hover:bg-blue-50"
                        >
                            <x-heroicon-o-eye class="h-4 w-4" />

                            Baca
                        </a>

                        <a
                            href="{{ asset('storage/' . $guide->file) }}"
                            download
                            class="inline-flex items-center gap-1.5 rounded-lg
                                border border-white/30 px-3 py-2
                                text-xs font-semibold text-white
                                transition hover:bg-white/10"
                        >
                            <x-heroicon-o-arrow-down-tray class="h-4 w-4" />

                            Download
                        </a>

                    </div>

                </div>

            @endif

                {{-- Search --}}
                <form
                    action="/documents"
                    method="GET"
                    class="mt-10">

                    <div
                        class="bg-white rounded-2xl shadow-xl p-2 flex">

                        <input
                            type="text"
                            name="search"
                            placeholder="Cari judul dokumen..."

                            class="flex-1 px-5 py-4 outline-none rounded-xl">

                        <button
                            class="bg-blue-700 hover:bg-blue-800 text-white px-8 rounded-xl font-semibold transition">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

            {{-- RIGHT --}}
            <div class="hidden lg:flex justify-center">

                <img
                    src="{{ asset('images/hero-library.png') }}"
                    class="w-full ">

            </div>

        </div>

    </div>

</section>

<section class="bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div
            class="grid grid-cols-2 lg:grid-cols-4 gap-6 -mt-12 relative z-20">

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <h2 class="text-4xl font-bold text-blue-700">
                    {{ number_format($stats['documents']) }}
                </h2>

                <p class="mt-2 text-gray-600">
                    Dokumen
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <h2 class="text-4xl font-bold text-blue-700">
                    {{ number_format($stats['authors']) }}
                </h2>

                <p class="mt-2 text-gray-600">
                    Penulis
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <h2 class="text-4xl font-bold text-blue-700">
                    {{ number_format($stats['categories']) }}
                </h2>

                <p class="mt-2 text-gray-600">
                    Kategori
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <h2 class="text-4xl font-bold text-blue-700">
                    {{ number_format($stats['downloads']) }}
                </h2>

                <p class="mt-2 text-gray-600">
                    Download
                </p>

            </div>

        </div>

    </div>

</section>

{{-- ========================= --}}
{{-- KATEGORI POPULER --}}
{{-- ========================= --}}

<section class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-10">

            <div>

                <h2 class="text-2xl font-bold">

                    Dokumen Terbaru

                </h2>

                <p class="text-gray-500 mt-2">

                    Koleksi terbaru yang telah dipublikasikan.

                </p>

            </div>

            <a
                href="/documents"
                class="text-blue-700 font-semibold mt-3 flex items-center gap-1.5">

                Lihat Semua <x-heroicon-o-arrow-right class="w-4 h-4" />

            </a>

        </div>

        <div class="space-y-6">

            @foreach($latestDocuments as $document)

                <x-document-list-item
                    :document="$document"/>

            @endforeach

        </div>

    </div>

</section>

@endsection