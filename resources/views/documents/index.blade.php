@extends('layouts.app')

@section('title', 'Koleksi Dokumen - DIGILIB STKIP')

@section('content')

<section class="min-h-screen py-10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-blue-600 mb-2">
                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                Repositori Digital
            </div>

            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                Koleksi Dokumen
            </h1>

            <p class="mt-2 text-sm sm:text-base text-slate-500 max-w-2xl">
                Jelajahi berbagai karya ilmiah, skripsi, modul, dan publikasi penelitian yang tersedia.
            </p>
        </div>


        {{-- Search --}}
        <form method="GET"
              action="{{ route('documents.index') }}"
              class="mb-8">

            <div class="relative flex flex-col sm:flex-row items-stretch gap-2 rounded-2xl bg-white p-2 shadow-sm ring-1 ring-slate-200 focus-within:ring-2 focus-within:ring-blue-500 transition-all">

                <div class="relative flex-1 flex items-center">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari judul, kata kunci, abstrak, atau isi dokumen..."
                        class="w-full border-0 bg-transparent py-3 pl-11 pr-4 text-sm sm:text-base text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0">
                </div>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-7 py-3 text-sm sm:text-base font-bold text-white shadow-sm hover:bg-blue-700 active:scale-[0.98] transition">
                    Cari Dokumen
                </button>

            </div>

        </form>


        <div class="grid gap-8 lg:grid-cols-4">

            {{-- SIDEBAR FILTER --}}
            <aside class="lg:col-span-1">

                <div class="sticky top-28 rounded-2xl border border-slate-200/90 bg-white p-5 sm:p-6 shadow-sm">

                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">

                        <div class="flex items-center gap-2">
                            <x-heroicon-o-funnel class="h-5 w-5 text-blue-600" />
                            <h2 class="text-base font-bold text-slate-900">
                                Filter Dokumen
                            </h2>
                        </div>

                        <a
                            href="{{ route('documents.index') }}"
                            class="text-xs font-semibold text-slate-500 hover:text-blue-600 transition">
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

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Kategori
                            </label>

                            <select
                                name="category"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition">

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

                        {{-- Program Studi --}}
                        <div class="border-t border-slate-100 pt-5">

                            <div class="mb-3">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                    Program Studi
                                </h3>
                            </div>

                            <div class="max-h-52 space-y-2 overflow-y-auto pr-1">

                                @foreach($studyPrograms as $prodi)

                                    <label
                                        class="flex cursor-pointer items-start gap-2.5 rounded-lg p-1.5 text-xs sm:text-sm text-slate-600 transition hover:bg-slate-50 hover:text-blue-700"
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
                                                border-slate-300 text-blue-600
                                                focus:ring-blue-500"
                                        >

                                        <span class="flex flex-1 items-center justify-between gap-2">

                                            <span class="leading-tight">
                                                {{ $prodi->nama_prodi }}
                                            </span>

                                            <span
                                                class="shrink-0 rounded-full bg-slate-100
                                                    px-2 py-0.5 text-[10px] font-semibold text-slate-500"
                                            >
                                                {{ $prodi->published_documents_count }}
                                            </span>

                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                        {{-- Tahun --}}
                        <div class="border-t border-slate-100 pt-5">

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Tahun Terbit
                            </label>

                            <select
                                name="tahun"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition">

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

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Urutkan Berdasarkan
                            </label>

                            <select
                                name="sort"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition">

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
                            class="w-full rounded-xl bg-blue-600 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700 active:scale-[0.98]">
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