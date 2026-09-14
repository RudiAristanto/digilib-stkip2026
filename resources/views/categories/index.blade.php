@extends('layouts.app')

@section('title', 'Kategori - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-12">

    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-900">
                Kategori Dokumen
            </h1>

            <p class="mt-2 text-slate-500">
                Jelajahi koleksi dokumen berdasarkan kategori.
            </p>

        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

            @foreach($categories as $category)

                <a
                    href="{{ route('categories.show', $category) }}"
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-blue-500 hover:shadow-md"
                >

                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                            <x-heroicon-o-folder class="h-6 w-6" />
                        </div>

                        <span class="text-sm text-slate-500">
                            {{ $category->documents_count }} Dokumen
                        </span>

                    </div>

                    <h2 class="mt-5 text-lg font-bold text-slate-900">
                        {{ $category->nama_kategori }}
                    </h2>

                    @if($category->deskripsi)
                        <p class="mt-2 text-sm text-slate-500 line-clamp-2">
                            {{ $category->deskripsi }}
                        </p>
                    @endif

                </a>

            @endforeach

        </div>

    </div>

</section>

@endsection