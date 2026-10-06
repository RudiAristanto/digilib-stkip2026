@extends('layouts.app')

@section('title', 'DIGILIB STKIP')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white">

    {{-- Subtle decorative background elements --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8 lg:py-28">

        <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">

            {{-- LEFT HERO CONTENT --}}
            <div class="lg:col-span-7 text-center lg:text-left">

                <div class="inline-flex items-center gap-2 rounded-full border border-blue-400/30 bg-blue-500/10 px-4 py-1.5 backdrop-blur-md">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-semibold uppercase tracking-wider text-blue-200">
                        Digital Repository STKIP
                    </span>
                </div>

                <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl leading-[1.15]">
                    Temukan Ribuan <br class="hidden sm:inline" />
                    <span class="bg-gradient-to-r from-yellow-300 via-amber-200 to-yellow-400 bg-clip-text text-transparent">
                        Karya Ilmiah
                    </span>
                    secara Digital
                </h1>

                <p class="mt-5 text-base text-blue-100/90 sm:text-lg lg:max-w-xl leading-relaxed">
                    Akses mudah ke skripsi, jurnal, tugas akhir, dan publikasi penelitian sivitas akademika STKIP dalam satu platform terpadu.
                </p>

                {{-- USER GUIDE BADGE IF AVAILABLE --}}
                @if($userGuides->count())
                    @php
                        $guide = $userGuides->first();
                    @endphp

                    <div class="mt-8 flex flex-col gap-3 rounded-2xl border border-white/15 bg-white/10 p-3.5 backdrop-blur-md transition hover:bg-white/15 sm:flex-row sm:items-center sm:justify-between text-left">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-500/30 text-yellow-300 border border-white/10 shadow-inner">
                                <x-heroicon-o-book-open class="h-5 w-5" />
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $guide->judul }}
                                </p>
                                <p class="text-xs text-blue-200">
                                    Panduan pengoperasian repositori
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 self-end sm:self-center">
                            <a
                                href="{{ asset('storage/' . $guide->file) }}"
                                target="_blank"
                                class="inline-flex items-center gap-1 rounded-lg bg-white px-3 py-1.5 text-xs font-bold text-blue-900 shadow-sm transition hover:bg-blue-50"
                            >
                                <x-heroicon-o-eye class="h-3.5 w-3.5 text-blue-700" />
                                Baca
                            </a>

                            <a
                                href="{{ asset('storage/' . $guide->file) }}"
                                download
                                class="inline-flex items-center gap-1 rounded-lg border border-white/30 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-white/10"
                            >
                                <x-heroicon-o-arrow-down-tray class="h-3.5 w-3.5" />
                                Unduh
                            </a>
                        </div>
                    </div>
                @endif

                {{-- SEARCH BOX --}}
                <form
                    action="{{ route('documents.index') }}"
                    method="GET"
                    class="mt-8"
                >
                    <div class="relative flex flex-col sm:flex-row items-stretch rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-black/5 focus-within:ring-2 focus-within:ring-blue-400 transition-all">
                        <div class="relative flex-1 flex items-center">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                            </div>
                            <input
                                type="text"
                                name="search"
                                placeholder="Cari judul dokumen, kata kunci, abstrak..."
                                class="w-full border-0 bg-transparent py-3.5 pl-12 pr-4 text-sm sm:text-base text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0"
                            >
                        </div>

                        <button
                            type="submit"
                            class="mt-2 sm:mt-0 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm sm:text-base font-bold text-white shadow-md hover:bg-blue-700 active:scale-[0.98] transition-all"
                        >
                            <span>Cari</span>
                            <x-heroicon-o-arrow-right class="h-4 w-4" />
                        </button>
                    </div>
                </form>

            </div>

            {{-- RIGHT HERO ILLUSTRATION --}}
            <div class="hidden lg:col-span-5 lg:flex justify-center items-center">
                <div class="relative w-full max-w-md">
                    <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-blue-400 to-indigo-400 opacity-30 blur-2xl"></div>
                    <div class="relative overflow-hidden rounded-3xl border border-white/20 bg-white/10 p-4 backdrop-blur-xl shadow-2xl">
                        <img
                            src="{{ asset('images/hero-library.png') }}"
                            alt="Perpustakaan Digital"
                            class="w-full h-auto object-contain drop-shadow-md rounded-2xl"
                            loading="eager"
                        >
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

{{-- STATS SECTION --}}
<section class="relative z-20 -mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-document-text class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['documents']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Dokumen Ilmiah
                </p>
            </div>
        </div>

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-users class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['authors']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Penulis & Sivitas
                </p>
            </div>
        </div>

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-folder-open class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['categories']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Kategori Repositori
                </p>
            </div>
        </div>

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-arrow-down-tray class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['downloads']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Total Diunduh
                </p>
            </div>
        </div>

    </div>

</section>

{{-- LATEST DOCUMENTS SECTION --}}
<section class="py-16 sm:py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-blue-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                    Publikasi Terbaru
                </div>

                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Dokumen & Riset Terkini
                </h2>

                <p class="text-sm sm:text-base text-slate-500 mt-1">
                    Koleksi karya ilmiah paling baru yang telah diverifikasi dan dipublikasikan.
                </p>
            </div>

            <a
                href="{{ route('documents.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-800 transition group self-start sm:self-auto"
            >
                <span>Lihat Semua Koleksi</span>
                <x-heroicon-o-arrow-right class="w-4 h-4 transition-transform group-hover:translate-x-1" />
            </a>

        </div>

        <div class="grid gap-5">

            @forelse($latestDocuments as $document)
                <x-document-list-item :document="$document" />
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 p-12 text-center bg-white">
                    <x-heroicon-o-document-magnifying-glass class="mx-auto h-12 w-12 text-slate-400" />
                    <h3 class="mt-2 text-sm font-bold text-slate-900">Belum ada dokumen</h3>
                    <p class="mt-1 text-sm text-slate-500">Silakan periksa kembali nanti.</p>
                </div>
            @endforelse

        </div>

    </div>

</section>

@endsection