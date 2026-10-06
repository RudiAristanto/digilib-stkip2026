@extends('layouts.app')

@section('title', 'Tentang - DIGILIB STKIP')

@section('content')

<section class="min-h-screen py-10 sm:py-16">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Card --}}
        <div class="relative overflow-hidden rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-10 lg:p-12 shadow-sm">

            <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-blue-600 mb-2">
                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                Tentang Repositori
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                DIGILIB <span class="text-blue-600">STKIP</span>
            </h1>

            <p class="mt-6 text-base sm:text-lg leading-relaxed text-slate-600">
                DIGILIB STKIP merupakan sistem repositori digital institusi yang dirancang untuk menyimpan, memelihara, dan menyediakan akses terbuka ke seluruh hasil penelitian, karya ilmiah mahasiswa, dan publikasi dosen di lingkungan STKIP.
            </p>

            <p class="mt-4 text-sm sm:text-base leading-relaxed text-slate-500">
                Koleksi akademik yang tersedia mencakup skripsi, tugas akhir, tesis, jurnal ilmiah, prosiding konferensi, modul pembelajaran, hingga laporan riset akademisi.
            </p>

            {{-- 3 Value Pillars --}}
            <div class="mt-10 grid gap-5 sm:grid-cols-3">

                <div class="group rounded-2xl border border-slate-100 bg-slate-50/60 p-6 transition-all duration-200 hover:bg-blue-50/50 hover:border-blue-100">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm mb-4">
                        <x-heroicon-o-magnifying-glass class="h-6 w-6" />
                    </div>

                    <h2 class="text-base font-bold text-slate-900">
                        Akses Terbuka & Cepat
                    </h2>

                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        Memudahkan mahasiswa, dosen, dan peneliti menemukan rujukan karya ilmiah kapan saja.
                    </p>
                </div>

                <div class="group rounded-2xl border border-slate-100 bg-slate-50/60 p-6 transition-all duration-200 hover:bg-blue-50/50 hover:border-blue-100">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm mb-4">
                        <x-heroicon-o-archive-box class="h-6 w-6" />
                    </div>

                    <h2 class="text-base font-bold text-slate-900">
                        Arsip Digital Terpusat
                    </h2>

                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        Dokumentasi permanen bagi setiap karya akademik dengan pengelompokan program studi yang rapi.
                    </p>
                </div>

                <div class="group rounded-2xl border border-slate-100 bg-slate-50/60 p-6 transition-all duration-200 hover:bg-blue-50/50 hover:border-blue-100">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm mb-4">
                        <x-heroicon-o-globe-alt class="h-6 w-6" />
                    </div>

                    <h2 class="text-base font-bold text-slate-900">
                        Dukungan Diseminasi
                    </h2>

                    <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                        Mendukung keterbacaan dan dampak sitasi dari hasil penelitian institusi secara luas.
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection