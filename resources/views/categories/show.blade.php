@extends('layouts.app')

@section('title', $category->nama_kategori . ' - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-12">

    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-8">

            <a
                href="{{ route('categories.index') }}"
                class="text-sm font-semibold text-blue-700"
            >
                ← Kembali ke Kategori
            </a>

            <h1 class="mt-4 text-3xl font-bold text-slate-900">
                {{ $category->nama_kategori }}
            </h1>

            <p class="mt-2 text-slate-500">
                Koleksi dokumen dalam kategori {{ $category->nama_kategori }}.
            </p>

        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

            @forelse($documents as $document)

                <x-document-list-item
                    :document="$document"
                    :loop="$loop"
                />

            @empty

                <div class="p-12 text-center text-slate-500">
                    Belum ada dokumen pada kategori ini.
                </div>

            @endforelse

        </div>

        <div class="mt-8">
            {{ $documents->links() }}
        </div>

    </div>

</section>

@endsection