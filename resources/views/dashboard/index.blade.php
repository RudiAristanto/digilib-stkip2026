@extends('layouts.app')

@section('title', 'Dashboard - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-7xl mx-auto px-6">

        @php
            $user = auth()->user();
            $author = $user->author;
        @endphp

        {{-- Header Dashboard --}}
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                {{-- Profil User --}}
                <div class="flex items-center gap-4">

                    {{-- Foto --}}
                    @if($author?->foto_url)

                        <img
                            src="{{ $author->foto_url }}"
                            alt="{{ $author->nama_penulis }}"
                            class="h-20 w-20 shrink-0 rounded-full
                                border-4 border-slate-100
                                object-cover shadow-sm"
                        >

                    @else

                        <div
                            class="flex h-20 w-20 shrink-0 items-center
                                justify-center rounded-full
                                border-4 border-slate-100
                                bg-slate-50"
                        >
                            <x-heroicon-o-user
                                class="h-9 w-9 text-slate-400"
                            />
                        </div>

                    @endif


                    {{-- Identitas --}}
                    <div class="min-w-0">

                        <p class="text-sm font-medium text-slate-500">
                            Selamat Datang,
                        </p>

                        <h1 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">
                            {{ $author?->nama_penulis ?? $user->name }}
                        </h1>

                        @if($author)

                            <div class="mt-2 flex flex-wrap items-center gap-2 text-sm text-slate-500">

                                @if($author->status)

                                    <span>
                                        {{ $author->status }}
                                    </span>

                                @endif


                                @if($author->status && $author->nim_nidn)
                                    <span class="text-slate-300">•</span>
                                @endif


                                @if($author->nim_nidn)

                                    <span>
                                        {{ $author->nim_nidn }}
                                    </span>

                                @endif

                            </div>

                        @else

                            <p class="mt-2 text-sm text-slate-500">
                                Kelola dan pantau dokumen yang Anda unggah.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Tombol Action --}}
                <div class="flex flex-wrap gap-3">

                    <a
                        href="{{ route('user.documents.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl
                            border border-blue-700 px-4 py-2.5
                            font-semibold text-blue-700
                            transition hover:bg-blue-50"
                    >
                        <x-heroicon-o-document-text class="h-5 w-5" />

                        Dokumen Saya
                    </a>


                    <a
                        href="{{ route('user.downloads') }}"
                        class="inline-flex items-center gap-2 rounded-xl
                            border border-slate-300 bg-white
                            px-4 py-2.5 font-semibold text-slate-700
                            transition hover:bg-slate-50"
                    >
                        <x-heroicon-o-arrow-down-tray class="h-5 w-5" />

                        Riwayat Download
                    </a>


                    <a
                        href="{{ route('user.documents.create') }}"
                        class="inline-flex items-center gap-2 rounded-xl
                            bg-blue-700 px-4 py-2.5
                            font-semibold text-white
                            transition hover:bg-blue-800"
                    >
                        <x-heroicon-o-plus class="h-5 w-5" />

                        Upload Dokumen
                    </a>

                </div>

            </div>

        </div>

    </div>


        {{-- =========================================================
    STATISTIK
========================================================= --}}
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">

    {{-- Total Dokumen --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5
                transition hover:-translate-y-0.5 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Total Dokumen
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ number_format($stats['total']) }}
                </p>
            </div>

            <div class="flex h-11 w-11 items-center justify-center
                        rounded-xl bg-blue-50 text-blue-700">
                <x-heroicon-o-document-text class="h-6 w-6" />
            </div>

        </div>

        <p class="mt-3 text-xs text-slate-400">
            Seluruh dokumen Anda
        </p>

    </div>


    {{-- Pending --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5
                transition hover:-translate-y-0.5 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Pending
                </p>

                <p class="mt-2 text-3xl font-bold text-amber-600">
                    {{ number_format($stats['pending']) }}
                </p>
            </div>

            <div class="flex h-11 w-11 items-center justify-center
                        rounded-xl bg-amber-50 text-amber-600">
                <x-heroicon-o-clock class="h-6 w-6" />
            </div>

        </div>

        <p class="mt-3 text-xs text-slate-400">
            Menunggu verifikasi admin
        </p>

    </div>


    {{-- Published --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5
                transition hover:-translate-y-0.5 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Published
                </p>

                <p class="mt-2 text-3xl font-bold text-emerald-600">
                    {{ number_format($stats['published']) }}
                </p>
            </div>

            <div class="flex h-11 w-11 items-center justify-center
                        rounded-xl bg-emerald-50 text-emerald-600">
                <x-heroicon-o-check-circle class="h-6 w-6" />
            </div>

        </div>

        <p class="mt-3 text-xs text-slate-400">
            Telah dipublikasikan
        </p>

    </div>


    {{-- Rejected --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5
                transition hover:-translate-y-0.5 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Rejected
                </p>

                <p class="mt-2 text-3xl font-bold text-red-600">
                    {{ number_format($stats['rejected']) }}
                </p>
            </div>

            <div class="flex h-11 w-11 items-center justify-center
                        rounded-xl bg-red-50 text-red-600">
                <x-heroicon-o-x-circle class="h-6 w-6" />
            </div>

        </div>

        <p class="mt-3 text-xs text-slate-400">
            Perlu diperbaiki
        </p>

    </div>


    {{-- Download --}}
    <div class="group rounded-2xl border border-slate-200 bg-white p-5
                transition hover:-translate-y-0.5 hover:shadow-md">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Total Download
                </p>

                <p class="mt-2 text-3xl font-bold text-blue-700">
                    {{ number_format($stats['downloads']) }}
                </p>
            </div>

            <div class="flex h-11 w-11 items-center justify-center
                        rounded-xl bg-indigo-50 text-indigo-600">
                <x-heroicon-o-arrow-down-tray class="h-6 w-6" />
            </div>

        </div>

        <p class="mt-3 text-xs text-slate-400">
            Unduhan dokumen Anda
        </p>

    </div>

</div>


{{-- =========================================================
    KONTEN DASHBOARD
========================================================= --}}
<div class="mt-8 grid gap-6 xl:grid-cols-5">

    {{-- =====================================================
        DOKUMEN TERBARU
    ====================================================== --}}
    <div class="xl:col-span-3">

        <div class="overflow-hidden rounded-2xl
                    border border-slate-200 bg-white">

            {{-- Header --}}
            <div class="flex items-center justify-between
                        border-b border-slate-200 px-6 py-5">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Dokumen Terbaru Saya
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Dokumen yang terakhir Anda unggah.
                    </p>

                </div>

                <a
                    href="{{ route('user.documents.index') }}"
                    class="text-sm font-semibold text-blue-700
                           hover:text-blue-800"
                >
                    Lihat Semua
                </a>

            </div>


            {{-- List --}}
            <div>

                @forelse($latestDocuments as $document)

                    <div class="border-b border-slate-100
                                px-6 py-5 last:border-b-0
                                transition hover:bg-slate-50">

                        <div class="flex items-start
                                    justify-between gap-5">

                            {{-- Informasi --}}
                            <div class="min-w-0">

                                <h3 class="font-semibold leading-6
                                           text-slate-900">

                                    {{ $document->judul }}

                                </h3>


                                <div class="mt-2 flex flex-wrap
                                            items-center gap-x-2 gap-y-1
                                            text-sm text-slate-500">

                                    @if($document->category)

                                        <span>
                                            {{ $document->category->nama_kategori }}
                                        </span>

                                    @endif


                                    @if($document->category && $document->tahun_terbit)
                                        <span class="text-slate-300">
                                            •
                                        </span>
                                    @endif


                                    @if($document->tahun_terbit)

                                        <span>
                                            {{ $document->tahun_terbit }}
                                        </span>

                                    @endif

                                    @if($document->studyProgram)

                                        <span class="text-slate-300">
                                            •
                                        </span>

                                        <span>
                                            {{ $document->studyProgram->nama_prodi }}
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- Status --}}
                            <span
                                class="shrink-0 rounded-full
                                       px-3 py-1 text-xs font-semibold

                                @if($document->status === 'published')
                                    bg-emerald-100 text-emerald-700

                                @elseif($document->status === 'pending')
                                    bg-amber-100 text-amber-700

                                @elseif($document->status === 'rejected')
                                    bg-red-100 text-red-700

                                @else
                                    bg-slate-100 text-slate-600
                                @endif
                            ">

                                {{ ucfirst($document->status) }}

                            </span>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <div class="mx-auto flex h-12 w-12
                                    items-center justify-center
                                    rounded-full bg-slate-100">

                            <x-heroicon-o-document-text
                                class="h-6 w-6 text-slate-400"
                            />

                        </div>

                        <p class="mt-3 font-medium text-slate-700">
                            Belum ada dokumen
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Dokumen yang Anda upload akan muncul di sini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =====================================================
        NOTIFIKASI
    ====================================================== --}}
    <div class="xl:col-span-2">

        <div class="overflow-hidden rounded-2xl
                    border border-slate-200 bg-white">

            {{-- Header --}}
            <div class="flex items-center justify-between
                        border-b border-slate-200 px-6 py-5">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Notifikasi
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi terbaru dokumen Anda.
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center
                            justify-center rounded-xl
                            bg-blue-50 text-blue-700">

                    <x-heroicon-o-bell class="h-5 w-5" />

                </div>

            </div>


            {{-- List --}}
            <div>

                @forelse($notifications as $notification)

                    @php
                        $status = $notification->data['status'] ?? null;
                    @endphp

                    <div class="border-b border-slate-100
                                px-6 py-5 last:border-b-0">

                        <div class="flex gap-3">

                            {{-- Icon --}}
                            <div
                                class="mt-0.5 flex h-9 w-9 shrink-0
                                       items-center justify-center
                                       rounded-full

                                {{ $status === 'published'
                                    ? 'bg-emerald-50 text-emerald-600'
                                    : ($status === 'rejected'
                                        ? 'bg-red-50 text-red-600'
                                        : 'bg-blue-50 text-blue-600') }}
                            ">

                                @if($status === 'published')

                                    <x-heroicon-o-check
                                        class="h-5 w-5"
                                    />

                                @elseif($status === 'rejected')

                                    <x-heroicon-o-x-mark
                                        class="h-5 w-5"
                                    />

                                @else

                                    <x-heroicon-o-bell
                                        class="h-5 w-5"
                                    />

                                @endif

                            </div>


                            {{-- Content --}}
                            <div class="min-w-0 flex-1">

                                <h3 class="line-clamp-2
                                           text-sm font-semibold
                                           leading-5 text-slate-900">

                                    {{ $notification->data['judul'] ?? 'Notifikasi' }}

                                </h3>


                                @if($status === 'published')

                                    <p class="mt-1 text-sm text-emerald-600">
                                        Dokumen Anda telah disetujui
                                        dan dipublikasikan.
                                    </p>

                                @elseif($status === 'rejected')

                                    <p class="mt-1 text-sm text-red-600">
                                        Dokumen Anda ditolak.
                                    </p>


                                    @if(!empty($notification->data['review_note']))

                                        <div class="mt-2 rounded-lg
                                                    bg-red-50 px-3 py-2">

                                            <p class="text-xs leading-5
                                                      text-red-700">

                                                <span class="font-semibold">
                                                    Catatan:
                                                </span>

                                                {{ $notification->data['review_note'] }}

                                            </p>

                                        </div>

                                    @endif

                                @endif


                                <p class="mt-2 text-xs text-slate-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <div class="mx-auto flex h-12 w-12
                                    items-center justify-center
                                    rounded-full bg-slate-100">

                            <x-heroicon-o-bell
                                class="h-6 w-6 text-slate-400"
                            />

                        </div>

                        <p class="mt-3 font-medium text-slate-700">
                            Belum ada notifikasi
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Informasi dokumen akan muncul di sini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

    </div>

</section>

@endsection