@extends('layouts.app')

@section('title', 'Akses Terbatas - DIGILIB STKIP')

@section('content')
<section class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full text-center">

        {{-- Icon & Badge --}}
        <div class="relative inline-flex items-center justify-center mb-6">
            <div class="absolute -inset-2 rounded-full bg-blue-500/10 blur-xl"></div>
            <div class="relative flex h-24 w-24 items-center justify-center rounded-3xl bg-blue-50 ring-1 ring-blue-100 shadow-md">
                <x-heroicon-o-lock-closed class="h-12 w-12 text-blue-600" />
            </div>
            <span class="absolute -bottom-1 -right-1 flex h-8 w-8 items-center justify-center rounded-full bg-amber-500 text-white shadow-sm ring-4 ring-white">
                <x-heroicon-o-exclamation-triangle class="h-4 w-4" />
            </span>
        </div>

        {{-- Badge Status --}}
        <div>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-amber-700 ring-1 ring-inset ring-amber-600/20">
                Akses Terbatas
            </span>
        </div>

        {{-- Heading --}}
        <h1 class="mt-4 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 leading-snug">
            Silakan Masuk atau Jadi Anggota untuk Mengakses Dokumen Ini
        </h1>

        {{-- Description --}}
        <p class="mt-3 text-sm sm:text-base leading-relaxed text-slate-600">
            Dokumen yang Anda tuju merupakan dokumen khusus sivitas akademika STKIP. Untuk membaca online atau mengunduh dokumen secara lengkap, silakan login menggunakan akun anggota Anda.
        </p>

        {{-- Notice for non-members --}}
        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50/70 p-4 text-xs sm:text-sm text-slate-600 leading-relaxed text-left">
            <div class="flex items-start gap-3">
                <x-heroicon-o-information-circle class="h-5 w-5 text-blue-600 shrink-0 mt-0.5" />
                <div>
                    <span class="font-bold text-slate-800">Belum memiliki akun anggota?</span>
                    <p class="mt-0.5 text-slate-600">
                        Pendaftaran akun anggota tidak dibuka secara mandiri. Silakan menghubungi <strong>petugas perpustakaan</strong> atau datang langsung ke bagian pelayanan perpustakaan STKIP untuk didaftarkan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-7 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a
                href="{{ route('login') }}"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3.5 text-sm font-bold text-white shadow-md hover:bg-blue-700 active:scale-[0.98] transition"
            >
                <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5" />
                <span>Masuk dengan Akun Anda</span>
            </a>
        </div>

        {{-- Back Link --}}
        <div class="mt-8 pt-6 border-t border-slate-200/80">
            <a
                href="{{ url()->previous() != url()->current() ? url()->previous() : route('documents.index') }}"
                class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-blue-600 transition"
            >
                <x-heroicon-o-arrow-left class="h-4 w-4" />
                <span>Kembali ke Halaman Sebelumnya</span>
            </a>
        </div>

    </div>
</section>
@endsection
