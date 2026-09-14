@extends('layouts.app')

@section('title', 'Penulis - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-12">

    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-900">
                Penulis
            </h1>

            <p class="mt-2 text-slate-500">
                Daftar mahasiswa dan dosen yang memiliki karya pada DIGILIB STKIP.
            </p>

        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            @foreach($authors as $author)

                <a
                    href="{{ route('authors.show', $author) }}"
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-blue-500 hover:shadow-md"
                >

                    <div class="flex items-start gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-700">

                            <x-heroicon-o-user class="h-6 w-6" />

                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900">
                                {{ $author->nama_penulis }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $author->status }}
                            </p>

                            @if($author->nim_nidn)
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $author->nim_nidn }}
                                </p>
                            @endif

                            <p class="mt-3 text-sm font-semibold text-blue-700">
                                {{ $author->documents_count }} Dokumen
                            </p>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

        <div class="mt-8">
            {{ $authors->links() }}
        </div>

    </div>

</section>

@endsection