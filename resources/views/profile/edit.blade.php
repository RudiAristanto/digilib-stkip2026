@extends('layouts.app')

@section('title', 'Profil Saya - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-5xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-slate-900">
                    Profil Saya
                </h1>

                <p class="mt-2 text-slate-500">
                    Kelola informasi akun dan keamanan akun Anda.
                </p>

            </div>

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2
                       rounded-xl border border-slate-300
                       bg-white px-5 py-3 font-semibold
                       text-slate-700 hover:bg-slate-50"
            >
                <x-heroicon-o-arrow-left class="w-5 h-5" />

                Kembali
            </a>

        </div>


        <div class="space-y-6">

            {{-- Informasi Profil --}}
            <div
                class="rounded-2xl border border-slate-200
                       bg-white p-7 shadow-sm"
            >

                <div class="mb-6">

                    <h2 class="text-xl font-bold text-slate-900">
                        Informasi Profil
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Perbarui nama dan alamat email akun Anda.
                    </p>

                </div>

                @include('profile.partials.update-profile-information-form')

            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-photo-form')
                </div>
            </div>

            {{-- Password --}}
            <div
                class="rounded-2xl border border-slate-200
                       bg-white p-7 shadow-sm"
            >

                <div class="mb-6">

                    <h2 class="text-xl font-bold text-slate-900">
                        Ubah Password
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Gunakan password yang kuat untuk menjaga keamanan akun.
                    </p>

                </div>

                @include('profile.partials.update-password-form')

            </div>


            {{-- Delete Account --}}
            <div
                class="rounded-2xl border border-red-200
                       bg-white p-7 shadow-sm"
            >

                <div class="mb-6">

                    <h2 class="text-xl font-bold text-red-700">
                        Hapus Akun
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Penghapusan akun bersifat permanen.
                    </p>

                </div>

                @include('profile.partials.delete-user-form')

            </div>

        </div>

    </div>

</section>

@endsection