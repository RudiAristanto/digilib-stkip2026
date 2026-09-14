@extends('layouts.app')

@section('title', $document->judul . ' - DIGILIB STKIP')

@section('content')

<section class="bg-slate-50 min-h-screen py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Breadcrumb --}}
        <div class="mb-6 flex items-center justify-between">

            <div class="flex items-center gap-3 text-sm text-slate-500">

                <a
                    href="{{ route('home') }}"
                    class="hover:text-blue-700"
                >
                    Beranda
                </a>

                <span>/</span>

                <a
                    href="{{ route('documents.index') }}"
                    class="hover:text-blue-700"
                >
                    Dokumen
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Detail
                </span>

            </div>

            @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 rounded-lg
                        border border-slate-300 bg-white px-4 py-2
                        text-sm font-semibold text-slate-700
                        transition hover:bg-slate-50 hover:text-blue-700"
                >
                    <x-heroicon-o-arrow-left class="h-4 w-4" />

                    Kembali ke Dashboard
                </a>

            @endauth

        </div>


        {{-- DETAIL UTAMA --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="grid lg:grid-cols-[240px_1fr] gap-8 p-7">

                {{-- Cover --}}
                <div>

                    @if($document->cover)

                        <img
                            src="{{ asset('storage/' . $document->cover) }}"
                            alt="{{ $document->judul }}"
                            class="w-full rounded-xl border border-slate-200 shadow-sm">

                    @else

                        <div class="aspect-[3/4] rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center">

                            <x-heroicon-o-document-text
                                class="w-16 h-16 text-slate-400" />

                        </div>

                    @endif

                </div>


                {{-- Metadata --}}
                <div>

                    <div class="flex flex-wrap gap-2 mb-4">

                        <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

                            {{ $document->category?->nama_kategori ?? '-' }}

                        </span>

                        <span class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-sm">

                            {{ $document->tahun_terbit }}

                        </span>

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium
                            {{ $document->access_type === 'public'
                                ? 'bg-emerald-100 text-emerald-700'
                                : 'bg-amber-100 text-amber-700' }}">

                            {{ ucfirst($document->access_type) }}

                        </span>

                    </div>


                    <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 leading-tight">

                        {{ $document->judul }}

                    </h1>


                    <div class="mt-5 space-y-3 text-slate-600">

                        <div class="flex items-center gap-3">

                            <x-heroicon-o-user class="w-5 h-5 text-slate-400" />

                            <div>
                                <span class="text-sm text-slate-400">
                                    Penulis
                                </span>

                                <div class="font-medium text-slate-700">

                                    {{ $document->author?->nama_penulis ?? '-' }}

                                </div>
                            </div>

                        </div>


                        <div class="flex items-center gap-3">

                            <x-heroicon-o-calendar-days class="w-5 h-5 text-slate-400" />

                            <div>
                                <span class="text-sm text-slate-400">
                                    Tahun Terbit
                                </span>

                                <div class="font-medium text-slate-700">

                                    {{ $document->tahun_terbit }}

                                </div>
                            </div>

                        </div>


                        <div class="flex items-center gap-3">

                            <x-heroicon-o-language class="w-5 h-5 text-slate-400" />

                            <div>
                                <span class="text-sm text-slate-400">
                                    Bahasa
                                </span>

                                <div class="font-medium text-slate-700">

                                    {{ $document->bahasa ?? 'Indonesia' }}

                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- Statistik --}}
                    <div class="mt-7 flex flex-wrap gap-6 border-t border-slate-200 pt-6">

                        <div class="flex items-center gap-2 text-slate-600">

                            <x-heroicon-o-eye class="w-5 h-5" />

                            <span>
                                {{ number_format($document->jumlah_view) }} View
                            </span>

                        </div>

                        <div class="flex items-center gap-2 text-slate-600">

                            <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                            <span>
                                {{ number_format($document->jumlah_download) }} Download
                            </span>

                        </div>

                        <div class="flex items-center gap-2 text-slate-600">

                            <x-heroicon-o-circle-stack class="w-5 h-5" />

                            <span>
                                {{ $document->formatted_file_size }}
                            </span>

                        </div>

                    </div>


                    {{-- Action --}}
                    <div class="mt-8 flex flex-wrap gap-3">

                        <a
                            href="{{ route('pdf.viewer', $document) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-blue-700 px-5 py-3 font-semibold text-white hover:bg-blue-800 transition">

                            <x-heroicon-o-book-open class="w-5 h-5" />

                            Baca Online

                        </a>

                        <a
                            href="{{ route('documents.download', $document) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-blue-700 px-5 py-3 font-semibold text-blue-700 hover:bg-blue-50 transition">

                            <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

                            Download PDF

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- ABSTRAK --}}
        <div class="mt-7 bg-white rounded-2xl border border-slate-200 p-7 shadow-sm">

            <h2 class="text-xl font-bold text-slate-900">
                Abstrak
            </h2>

            <div class="mt-4 leading-8 text-slate-600">

                {!! $document->abstrak !!}

            </div>

        </div>


        {{-- KATA KUNCI --}}
        @if($document->kata_kunci)

            <div class="mt-7 bg-white rounded-2xl border border-slate-200 p-7 shadow-sm">

                <h2 class="text-xl font-bold text-slate-900">
                    Kata Kunci
                </h2>

                <div class="mt-4 flex flex-wrap gap-2">

                    @foreach(explode(',', $document->kata_kunci) as $keyword)

                        <span class="rounded-full bg-slate-100 px-3 py-1.5 text-sm text-slate-700">

                            {{ trim($keyword) }}

                        </span>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- DOKUMEN TERKAIT --}}
        @if($relatedDocuments->count())

            <div class="mt-10">

                <div class="mb-5">

                    <h2 class="text-2xl font-bold text-slate-900">
                        Dokumen Terkait
                    </h2>

                    <p class="mt-1 text-slate-500">
                        Dokumen lain dalam kategori yang sama.
                    </p>

                </div>


                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

                    @foreach($relatedDocuments as $related)

                        <x-document-list-item
                            :document="$related"
                            :loop="$loop" />

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</section>

@endsection