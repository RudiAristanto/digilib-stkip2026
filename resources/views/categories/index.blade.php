@extends('layouts.app')

@section('title', 'Kategori - DIGILIB STKIP')

@section('content')

<section class="min-h-screen py-10 sm:py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-blue-600 mb-2">
                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                Klasifikasi Dokumen
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                Kategori Dokumen
            </h1>

            <p class="mt-2 text-sm sm:text-base text-slate-500">
                Jelajahi koleksi karya akademik dan dokumen berdasarkan kategori atau jenis penelitian.
            </p>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @foreach($categories as $category)

                <a
                    href="{{ route('categories.show', $category) }}"
                    class="group relative flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-400 hover:shadow-lg"
                >

                    <div>
                        <div class="flex items-center justify-between">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                                <x-heroicon-o-folder class="h-6 w-6" />
                            </div>

                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                {{ $category->documents_count }} Dokumen
                            </span>

                        </div>

                        <h2 class="mt-5 text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">
                            {{ $category->nama_kategori }}
                        </h2>

                        @if($category->deskripsi)
                            <p class="mt-2 text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $category->deskripsi }}
                            </p>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center gap-1.5 text-xs font-bold text-blue-600 group-hover:text-blue-800 transition">
                        <span>Lihat Dokumen</span>
                        <x-heroicon-o-arrow-right class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1" />
                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>

@endsection