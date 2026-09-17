@extends('layouts.app')

@section('title', 'Koleksi Dokumen - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-8">

            <h1 class="text-3xl md:text-4xl font-bold text-slate-800">
                Koleksi Dokumen
            </h1>

            <p class="mt-2 text-slate-500">
                Jelajahi berbagai koleksi karya ilmiah dan dokumen akademik.
            </p>

        </div>


        {{-- Search --}}
        <form method="GET"
              action="{{ route('documents.index') }}"
              class="mb-8">

            <div class="flex flex-col md:flex-row gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul, kata kunci, atau isi dokumen..."
                    class="w-full flex-1 rounded-xl border border-slate-300 bg-white px-5 py-3.5 text-slate-700 outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100">

                <button
                    type="submit"
                    class="rounded-xl bg-blue-700 px-8 py-3.5 font-semibold text-white transition hover:bg-blue-800">

                    Cari

                </button>

            </div>

        </form>


        <div class="grid gap-8 lg:grid-cols-4">

            {{-- SIDEBAR FILTER --}}
            <aside class="lg:col-span-1">

                <div class="sticky top-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="mb-6 flex items-center justify-between">

                        <h2 class="text-lg font-bold text-slate-800">
                            Filter Dokumen
                        </h2>

                        <a
                            href="{{ route('documents.index') }}"
                            class="text-sm font-medium text-blue-700 hover:text-blue-900">

                            Reset

                        </a>

                    </div>


                    <form
                        method="GET"
                        action="{{ route('documents.index') }}"
                        class="space-y-5">

                        {{-- Pertahankan Search --}}
                        @if(request('search'))

                            <input
                                type="hidden"
                                name="search"
                                value="{{ request('search') }}">

                        @endif


                        {{-- Kategori --}}
                        <div>

                            <label class="mb-2 block font-semibold text-slate-700">

                                Kategori

                            </label>

                            <select
                                name="category"
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                                <option value="">
                                    Semua Kategori
                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(request('category') == $category->id)>

                                        {{ $category->nama_kategori }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="mb-2 block font-semibold text-slate-700">
                                Penulis
                            </label>

                            <select
                                name="author"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3"
                            >

                                <option value="">
                                    Semua Penulis
                                </option>

                                @foreach($authors as $author)

                                    <option
                                        value="{{ $author->id }}"
                                        @selected(request('author') == $author->id)
                                    >
                                        {{ $author->nama_penulis }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Program Studi --}}
                        <div class="border-t border-slate-200 pt-5">

                            <div class="mb-3">
                                <h3 class="font-semibold text-slate-700">
                                    Program Studi
                                </h3>

                                <div class="mt-2 h-0.5 w-12 rounded bg-yellow-400"></div>
                            </div>

                            <div class="max-h-56 space-y-2.5 overflow-y-auto pr-2">

                                @foreach($studyPrograms as $prodi)

                                    <label
                                        class="flex cursor-pointer items-start gap-2.5
                                            text-sm text-slate-600 transition
                                            hover:text-blue-700"
                                    >

                                        <input
                                            type="checkbox"
                                            name="prodi[]"
                                            value="{{ $prodi->id }}"

                                            @checked(
                                                in_array(
                                                    (string) $prodi->id,
                                                    array_map(
                                                        'strval',
                                                        (array) request('prodi', [])
                                                    )
                                                )
                                            )

                                            class="mt-0.5 h-4 w-4 rounded
                                                border-slate-300 text-blue-700
                                                focus:ring-blue-600"
                                        >

                                        <span class="flex flex-1 items-center justify-between gap-2">

                                            <span class="leading-5">
                                                {{ $prodi->nama_prodi }}
                                            </span>

                                            <span
                                                class="shrink-0 rounded-full bg-slate-100
                                                    px-2 py-0.5 text-xs font-medium text-slate-500"
                                            >
                                                {{ $prodi->published_documents_count }}
                                            </span>

                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                        {{-- Tahun --}}
                        <div>

                            <label class="mb-2 block font-semibold text-slate-700">

                                Tahun Terbit

                            </label>

                            <select
                                name="tahun"
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                                <option value="">
                                    Semua Tahun
                                </option>

                                @foreach($years as $year)

                                    <option
                                        value="{{ $year }}"
                                        @selected(request('tahun') == $year)>

                                        {{ $year }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Urutkan --}}
                        <div>

                            <label class="mb-2 block font-semibold text-slate-700">

                                Urutkan

                            </label>

                            <select
                                name="sort"
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                                <option
                                    value="latest"
                                    @selected(request('sort', 'latest') === 'latest')>

                                    Terbaru

                                </option>

                                <option
                                    value="oldest"
                                    @selected(request('sort') === 'oldest')>

                                    Terlama

                                </option>

                                <option
                                    value="popular"
                                    @selected(request('sort') === 'popular')>

                                    Paling Banyak Diunduh

                                </option>

                                <option
                                    value="views"
                                    @selected(request('sort') === 'views')>

                                    Paling Banyak Dilihat

                                </option>

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="w-full rounded-xl bg-blue-700 py-3 font-semibold text-white transition hover:bg-blue-800">

                            Terapkan Filter

                        </button>

                    </form>

                </div>

            </aside>


            {{-- LIST DOKUMEN --}}
            <div class="lg:col-span-3">

                <div class="mb-5 flex items-center justify-between">

                    <p class="text-slate-500">

                        Menampilkan

                        <span class="font-semibold text-slate-800">
                            {{ $documents->total() }}
                        </span>

                        dokumen

                    </p>

                </div>


                @if($documents->count())

                    <div class="space-y-5">

                        @foreach($documents as $document)

                            <x-document-list-item
                                :document="$document" />

                        @endforeach

                    </div>


                    {{-- Pagination --}}
                    <div class="mt-10">

                        {{ $documents->links() }}

                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="rounded-2xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">

                        <h3 class="text-xl font-bold text-slate-800">

                            Dokumen tidak ditemukan

                        </h3>

                        <p class="mt-2 text-slate-500">

                            Coba gunakan kata kunci atau filter yang berbeda.

                        </p>

                        <a
                            href="{{ route('documents.index') }}"
                            class="mt-6 inline-block font-semibold text-blue-700 hover:text-blue-900">

                            Reset Pencarian →

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection