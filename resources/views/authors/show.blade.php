@extends('layouts.app')

@section('title', $author->nama_penulis . ' - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-12">

    <div class="max-w-7xl mx-auto px-6">

        <a
            href="{{ route('authors.index') }}"
            class="text-sm font-semibold text-blue-700"
        >
            ← Kembali ke Penulis
        </a>

        <div class="mt-5 rounded-2xl border border-slate-200 bg-white p-7">

            <h1 class="text-3xl font-bold text-slate-900">
                {{ $author->nama_penulis }}
            </h1>

            <div class="mt-3 flex flex-wrap gap-4 text-sm text-slate-500">

                <span>{{ $author->status }}</span>

                @if($author->nim_nidn)
                    <span>{{ $author->nim_nidn }}</span>
                @endif

                @if($author->email)
                    <span>{{ $author->email }}</span>
                @endif

            </div>

        </div>

        <div class="mt-8">

            <h2 class="mb-5 text-2xl font-bold text-slate-900">
                Karya Ilmiah
            </h2>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                @forelse($documents as $document)

                    <x-document-list-item
                        :document="$document"
                        :loop="$loop"
                    />

                @empty

                    <div class="p-12 text-center text-slate-500">
                        Penulis ini belum memiliki dokumen yang dipublikasikan.
                    </div>

                @endforelse

            </div>

            <div class="mt-8">
                {{ $documents->links() }}
            </div>

        </div>

    </div>

</section>

@endsection