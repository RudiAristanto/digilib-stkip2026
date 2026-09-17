@extends('layouts.app')

@section('title', 'Dokumen Saya - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h1 class="text-3xl font-bold text-slate-900">
                    Dokumen Saya
                </h1>

                <p class="mt-2 text-slate-500">
                    Kelola dan pantau seluruh dokumen yang Anda unggah.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                        border border-slate-300 bg-white px-5 py-3
                        font-semibold text-slate-700 transition
                        hover:bg-slate-50 hover:text-blue-700"
                >
                    <x-heroicon-o-arrow-left class="h-5 w-5" />

                    Kembali
                </a>

                <a
                    href="{{ route('user.documents.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                        bg-blue-700 px-5 py-3 font-semibold text-white
                        transition hover:bg-blue-800"
                >
                    <x-heroicon-o-plus class="h-5 w-5" />

                    Upload Dokumen
                </a>

            </div>

        </div>


        {{-- FILTER STATUS --}}
        <div class="mb-6 flex flex-wrap gap-2">

            <a
                href="{{ route('user.documents.index') }}"
                class="rounded-full px-4 py-2 text-sm font-semibold
                {{ !request('status')
                    ? 'bg-blue-700 text-white'
                    : 'bg-white text-slate-600 border border-slate-200' }}"
            >
                Semua
            </a>

            <a
                href="{{ route('user.documents.index', ['status' => 'pending']) }}"
                class="rounded-full px-4 py-2 text-sm font-semibold
                {{ request('status') === 'pending'
                    ? 'bg-amber-500 text-white'
                    : 'bg-white text-slate-600 border border-slate-200' }}"
            >
                Pending
            </a>

            <a
                href="{{ route('user.documents.index', ['status' => 'published']) }}"
                class="rounded-full px-4 py-2 text-sm font-semibold
                {{ request('status') === 'published'
                    ? 'bg-emerald-600 text-white'
                    : 'bg-white text-slate-600 border border-slate-200' }}"
            >
                Published
            </a>

            <a
                href="{{ route('user.documents.index', ['status' => 'rejected']) }}"
                class="rounded-full px-4 py-2 text-sm font-semibold
                {{ request('status') === 'rejected'
                    ? 'bg-red-600 text-white'
                    : 'bg-white text-slate-600 border border-slate-200' }}"
            >
                Rejected
            </a>

        </div>


        {{-- DOCUMENT LIST --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @forelse($documents as $document)

                <div class="border-b border-slate-200 p-6 last:border-b-0">

                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start">

                        {{-- COVER --}}
                        <div class="w-24 shrink-0">

                            @if($document->cover)

                                <img
                                    src="{{ asset('storage/' . $document->cover) }}"
                                    alt="{{ $document->judul }}"
                                    class="h-36 w-24 rounded-lg border border-slate-200 object-cover"
                                >

                            @else

                                <div class="flex h-36 w-24 items-center justify-center rounded-lg bg-slate-100">

                                    <x-heroicon-o-document-text
                                        class="h-9 w-9 text-slate-400"
                                    />

                                </div>

                            @endif

                        </div>


                        {{-- CONTENT --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-start justify-between gap-3">

                                <div>

                                    <div class="mb-2 flex flex-wrap gap-2">

                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

                                            {{ $document->category?->nama_kategori ?? '-' }}

                                        </span>

                                        {{-- STATUS --}}
                                        <span
                                            class="rounded-full px-3 py-1 text-xs font-semibold
                                            @if($document->status === 'published')
                                                bg-emerald-100 text-emerald-700
                                            @elseif($document->status === 'pending')
                                                bg-amber-100 text-amber-700
                                            @elseif($document->status === 'rejected')
                                                bg-red-100 text-red-700
                                            @else
                                                bg-slate-100 text-slate-600
                                            @endif"
                                        >
                                            {{ ucfirst($document->status) }}
                                        </span>

                                    </div>


                                    <h2 class="text-xl font-bold text-slate-900">

                                        {{ $document->judul }}

                                    </h2>

                                </div>

                                <span class="text-sm text-slate-500">

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>

                            </div>


                            <div class="mt-3 flex flex-wrap gap-5 text-sm text-slate-500">

                                <span>
                                    Tahun: {{ $document->tahun_terbit }}
                                </span>

                                <span>
                                    {{ $document->studyProgram?->nama_prodi ?? '-' }}
                                </span>

                                <span class="flex items-center gap-1">

                                    <x-heroicon-o-eye class="h-4 w-4" />

                                    {{ number_format($document->jumlah_view) }}
                                </span>

                                <span class="flex items-center gap-1">

                                    <x-heroicon-o-arrow-down-tray class="h-4 w-4" />

                                    {{ number_format($document->jumlah_download) }}
                                </span>

                            </div>


                            {{-- REVIEW NOTE --}}
                            @if(
                                $document->status === 'rejected'
                                && $document->review_note
                            )

                                <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4">

                                    <p class="text-sm font-semibold text-red-700">
                                        Catatan Admin
                                    </p>

                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $document->review_note }}
                                    </p>

                                </div>

                            @endif


                            {{-- ACTION --}}
                            <div class="mt-5 flex flex-wrap gap-3">

                                @if(in_array($document->status, ['pending', 'rejected']))

                                    <a
                                        href="{{ route('user.documents.edit', $document) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-700 hover:bg-amber-100"
                                    >
                                        <x-heroicon-o-pencil-square class="h-4 w-4" />

                                        Edit Dokumen
                                    </a>

                                @endif

                                @if($document->status === 'published')

                                    <a
                                        href="{{ route('documents.show', $document) }}"
                                        class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                                    >
                                        <x-heroicon-o-eye class="h-4 w-4" />

                                        Lihat Detail
                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="py-16 text-center">

                    <x-heroicon-o-document-text
                        class="mx-auto h-12 w-12 text-slate-300"
                    />

                    <h3 class="mt-4 text-lg font-semibold text-slate-800">
                        Belum ada dokumen
                    </h3>

                    <p class="mt-1 text-slate-500">
                        Anda belum mengunggah dokumen.
                    </p>

                </div>

            @endforelse

        </div>


        @if($documents->hasPages())

            <div class="mt-8">
                {{ $documents->links() }}
            </div>

        @endif

    </div>

</section>

@endsection