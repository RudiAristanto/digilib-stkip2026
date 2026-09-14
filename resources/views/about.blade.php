@extends('layouts.app')

@section('title', 'Tentang - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-12">

    <div class="max-w-5xl mx-auto px-6">

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">

            <span class="text-sm font-semibold uppercase tracking-wider text-blue-700">
                Tentang DIGILIB
            </span>

            <h1 class="mt-3 text-4xl font-bold text-slate-900">
                DIGILIB STKIP
            </h1>

            <p class="mt-5 leading-8 text-slate-600">
                DIGILIB STKIP merupakan repositori digital yang digunakan untuk
                menyimpan, mengelola, mencari, membaca, dan menyebarluaskan karya
                ilmiah mahasiswa dan dosen.
            </p>

            <p class="mt-4 leading-8 text-slate-600">
                Koleksi yang tersedia meliputi skripsi, tesis, jurnal, buku,
                artikel ilmiah, laporan penelitian, prosiding, dan berbagai
                karya tulis ilmiah lainnya.
            </p>

            <div class="mt-10 grid gap-5 md:grid-cols-3">

                <div class="rounded-xl bg-blue-50 p-5">
                    <h2 class="font-bold text-blue-800">
                        Akses Mudah
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Memudahkan sivitas akademika menemukan karya ilmiah.
                    </p>
                </div>

                <div class="rounded-xl bg-blue-50 p-5">
                    <h2 class="font-bold text-blue-800">
                        Arsip Digital
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Menyimpan karya akademik secara terstruktur dan terdokumentasi.
                    </p>
                </div>

                <div class="rounded-xl bg-blue-50 p-5">
                    <h2 class="font-bold text-blue-800">
                        Publikasi
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Membantu penyebarluasan hasil karya ilmiah kampus.
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection