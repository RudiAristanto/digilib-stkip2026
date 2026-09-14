@extends('layouts.app')

@section('title', 'Riwayat Download - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-6xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="mb-8 flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-slate-900">
                    Riwayat Download
                </h1>

                <p class="mt-2 text-slate-500">
                    Daftar dokumen yang pernah Anda unduh.
                </p>

            </div>

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 rounded-xl
                       border border-slate-300 bg-white px-5 py-3
                       font-semibold text-slate-700
                       hover:bg-slate-50"
            >
                <x-heroicon-o-arrow-left class="w-5 h-5" />

                Kembali
            </a>

        </div>


        {{-- LIST --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

            @forelse($downloads as $download)

                <div class="border-b border-slate-200 p-5 last:border-b-0">

                    <div class="flex items-start justify-between gap-5">

                        <div>

                            <a
                                href="{{ route('documents.show', $download->document) }}"
                                class="text-lg font-semibold text-blue-800 hover:text-blue-600"
                            >
                                {{ $download->document?->judul ?? 'Dokumen tidak tersedia' }}
                            </a>

                            <div class="mt-2 flex flex-wrap gap-3 text-sm text-slate-500">

                                <span>
                                    {{ $download->document?->author?->nama_penulis ?? '-' }}
                                </span>

                                <span>•</span>

                                <span>
                                    {{ $download->document?->category?->nama_kategori ?? '-' }}
                                </span>

                                <span>•</span>

                                <span>
                                    {{ $download->document?->tahun_terbit ?? '-' }}
                                </span>

                            </div>

                        </div>

                        <div class="text-right text-sm text-slate-500">

                            {{ optional($download->downloaded_at)->format('d M Y H:i') }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-12 text-center">

                    <x-heroicon-o-arrow-down-tray
                        class="mx-auto h-12 w-12 text-slate-300"
                    />

                    <h3 class="mt-4 font-semibold text-slate-800">
                        Belum ada riwayat download
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Dokumen yang Anda download akan tampil di sini.
                    </p>

                </div>

            @endforelse

        </div>


        @if($downloads->hasPages())

            <div class="mt-8">
                {{ $downloads->links() }}
            </div>

        @endif

    </div>

</section>

@endsection