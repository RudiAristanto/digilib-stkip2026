@extends('layouts.app')

@section('title', 'DIGILIB STKIP - Digital Library & Repository')

@section('content')

{{-- HERO BANNER SLIDER --}}
<section
    x-data="{
        activeSlide: 0,
        totalSlides: {{ max(1, $banners->count()) }},
        autoplayTimer: null,
        startAutoplay() {
            if (this.totalSlides > 1) {
                this.autoplayTimer = setInterval(() => {
                    this.nextSlide();
                }, 6000);
            }
        },
        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
            }
        },
        nextSlide() {
            this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
        },
        prevSlide() {
            this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
        },
        goTo(index) {
            this.activeSlide = index;
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()"
    class="relative overflow-hidden bg-[#0f172a] text-white select-none border-b border-slate-800"
    style="background: linear-gradient(135deg, #0a1128 0%, #102a43 50%, #1e1e38 100%); color: #ffffff;"
>

    {{-- Subtle Academic Backdrop Elements --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-32 -right-32 h-[32rem] w-[32rem] rounded-full bg-blue-600/15 blur-[120px]"></div>
        <div class="absolute -bottom-32 -left-32 h-[32rem] w-[32rem] rounded-full bg-indigo-600/15 blur-[120px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    {{-- MAIN HERO WRAPPER --}}
    <div
        class="relative mx-auto max-w-7xl px-4 pb-16 sm:px-6 sm:pb-20 lg:px-8 lg:pb-24"
        style="padding-top: clamp(3.5rem, 6vw, 6rem);"
    >

        <div class="grid items-center gap-8 lg:grid-cols-12 lg:gap-12">

            {{-- LEFT COLUMN: SLIDING HEADINGS + FIXED PETUNJUK & PENCARIAN --}}
            <div class="lg:col-span-7 text-center lg:text-left z-10">

                {{-- 1. SLIDING TEXT (Hanya Badge, Judul, Deskripsi, dan Link CTA yang berganti slide) --}}
                <div class="relative overflow-hidden min-h-[220px] sm:min-h-[240px] lg:min-h-[260px]">
                    @forelse($banners as $index => $banner)
                        <div
                            x-cloak
                            x-show="activeSlide === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-300 absolute inset-0"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-4"
                            class="w-full"
                        >
                            {{-- BADGE DENGAN KOTAK JELAS & EFEK SHADOW --}}
                            @if($banner->badge)
                                <div class="inline-flex items-center gap-2 rounded-full border border-blue-400/40 bg-blue-900/60 px-4 py-1.5 backdrop-blur-md shadow-md shadow-black/40 ring-1 ring-white/10">
                                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-blue-100">
                                        {{ $banner->badge }}
                                    </span>
                                </div>
                            @endif

                            {{-- HEADING --}}
                            <h1 class="mt-4 text-3xl sm:text-5xl lg:text-[3.25rem] font-extrabold tracking-tight text-white leading-[1.18]">
                                {{ $banner->judul }}
                                @if($banner->judul_sorot)
                                    <br class="hidden sm:inline" />
                                    <span class="bg-gradient-to-r from-amber-300 via-yellow-200 to-amber-400 bg-clip-text text-transparent">
                                        {{ $banner->judul_sorot }}
                                    </span>
                                @endif
                            </h1>

                            {{-- DESCRIPTION --}}
                            @if($banner->deskripsi)
                                <p class="mt-3.5 text-sm sm:text-base text-slate-200/90 lg:max-w-xl leading-relaxed font-normal">
                                    {{ $banner->deskripsi }}
                                </p>
                            @endif

                            {{-- OPTIONAL CALL TO ACTION LINK --}}
                            @if($banner->tombol_teks && $banner->tombol_url)
                                <div class="mt-3 flex justify-center lg:justify-start">
                                    <a
                                        href="{{ $banner->tombol_url }}"
                                        class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-amber-300 hover:text-amber-200 transition underline underline-offset-4"
                                    >
                                        <span>{{ $banner->tombol_teks }}</span>
                                        <x-heroicon-o-arrow-right class="h-3.5 w-3.5" />
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="w-full">
                            <div class="inline-flex items-center gap-2 rounded-full border border-blue-400/40 bg-blue-900/60 px-4 py-1.5 backdrop-blur-md shadow-md shadow-black/40 ring-1 ring-white/10">
                                <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-100">
                                    DIGITAL REPOSITORY STKIP
                                </span>
                            </div>
                            <h1 class="mt-4 text-3xl sm:text-5xl lg:text-[3.25rem] font-extrabold tracking-tight text-white leading-[1.18]">
                                Temukan Ribuan <br class="hidden sm:inline" />
                                <span class="bg-gradient-to-r from-amber-300 via-yellow-200 to-amber-400 bg-clip-text text-transparent">
                                    Karya Ilmiah secara Digital
                                </span>
                            </h1>
                            <p class="mt-3.5 text-sm sm:text-base text-slate-200/90 lg:max-w-xl leading-relaxed font-normal">
                                Akses mudah ke skripsi, jurnal, tugas akhir, dan publikasi penelitian sivitas akademika STKIP dalam satu platform terpadu.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- 2. FIXED / STATIS: PETUNJUK PENGGUNAAN (DI LUAR SLIDER - TIDAK IKUT BERGERAK) --}}
                @if($userGuides->count())
                    @php
                        $guide = $userGuides->first();
                    @endphp
                    <div class="mt-5 flex flex-col gap-3 rounded-2xl border border-white/15 bg-white/10 p-3.5 backdrop-blur-md transition hover:bg-white/15 sm:flex-row sm:items-center sm:justify-between text-left shadow-lg shadow-black/20">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-500/30 text-yellow-300 border border-white/10 shadow-inner">
                                <x-heroicon-o-book-open class="h-5 w-5" />
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-white">
                                    {{ $guide->judul }}
                                </p>
                                <p class="text-xs text-blue-200">
                                    Panduan pengoperasian repositori
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 self-end sm:self-center">
                            <a
                                href="{{ asset('storage/' . $guide->file) }}"
                                target="_blank"
                                class="inline-flex items-center gap-1 rounded-lg bg-white px-3.5 py-1.5 text-xs font-bold text-blue-900 shadow-sm transition hover:bg-blue-50"
                            >
                                <x-heroicon-o-eye class="h-3.5 w-3.5 text-blue-700" />
                                Baca
                            </a>

                            <a
                                href="{{ asset('storage/' . $guide->file) }}"
                                download
                                class="inline-flex items-center gap-1 rounded-lg border border-white/30 px-3.5 py-1.5 text-xs font-semibold text-white transition hover:bg-white/10"
                            >
                                <x-heroicon-o-arrow-down-tray class="h-3.5 w-3.5" />
                                Unduh
                            </a>
                        </div>
                    </div>
                @endif

                {{-- 3. FIXED / STATIS: FORM PENCARIAN (DI LUAR SLIDER - TIDAK IKUT BERGERAK) --}}
                <form
                    action="{{ route('documents.index') }}"
                    method="GET"
                    class="mt-5"
                >
                    <div class="relative flex flex-col sm:flex-row items-stretch rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-black/10 focus-within:ring-2 focus-within:ring-amber-400 transition-all">
                        <div class="relative flex-1 flex items-center">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                            </div>
                            <input
                                type="text"
                                name="search"
                                placeholder="Cari judul dokumen, kata kunci, abstrak atau penulis..."
                                class="w-full border-0 bg-transparent py-3.5 pl-12 pr-4 text-sm sm:text-base text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-0"
                            >
                        </div>

                        <button
                            type="submit"
                            class="mt-2 sm:mt-0 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm sm:text-base font-bold text-white shadow-md hover:bg-blue-700 active:scale-[0.98] transition-all"
                        >
                            <span>Cari</span>
                            <x-heroicon-o-arrow-right class="h-4 w-4" />
                        </button>
                    </div>
                </form>

            </div>

            {{-- RIGHT COLUMN: SLIDING FOTO / BANNER GAMBAR --}}
            <div class="hidden lg:col-span-5 lg:flex justify-center items-center z-10">
                <div class="relative w-full max-w-lg">
                    {{-- Outer Soft Glow --}}
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-blue-600/30 to-amber-500/20 opacity-70 blur-2xl"></div>

                    {{-- Frame Image Slider --}}
                    <div class="relative overflow-hidden rounded-3xl border border-white/20 bg-slate-900/60 p-3.5 backdrop-blur-xl shadow-2xl transition hover:border-white/30">
                        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-b from-blue-900/50 to-slate-900/90 aspect-[4/3] flex items-center justify-center">
                            @forelse($banners as $index => $banner)
                                <img
                                    x-cloak
                                    x-show="activeSlide === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-700"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-300 absolute inset-0"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    src="{{ $banner->gambar_url }}"
                                    alt="{{ $banner->judul }}"
                                    class="w-full h-full object-cover object-center"
                                    loading="eager"
                                >
                            @empty
                                <img
                                    src="{{ asset('images/hero-library.png') }}"
                                    alt="DIGILIB STKIP"
                                    class="w-full h-full object-cover object-center"
                                >
                            @endforelse
                        </div>

                        {{-- Floating Repositori Indicator --}}
                        <div class="absolute bottom-6 left-6 right-6 rounded-xl border border-white/20 bg-slate-900/80 px-4 py-2.5 backdrop-blur-md shadow-lg flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/20 text-blue-300 border border-blue-400/30">
                                    <x-heroicon-o-academic-cap class="h-4 w-4" />
                                </div>
                                <span class="text-xs font-semibold text-white">Repositori Terakreditasi</span>
                            </div>
                            <span class="text-[11px] font-bold text-amber-300 bg-amber-400/10 px-2 py-0.5 rounded-full border border-amber-400/20">STKIP</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- SLIDER CONTROLS (ARROWS & DOTS) --}}
    @if($banners->count() > 1)
        {{-- PREV ARROW --}}
        <button
            @click="prevSlide()"
            type="button"
            aria-label="Slide sebelumnya"
            class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-slate-900/60 text-white/80 border border-white/20 backdrop-blur-md shadow-lg transition hover:bg-white hover:text-slate-900 hover:scale-105"
        >
            <x-heroicon-o-chevron-left class="h-5 w-5 sm:h-6 sm:w-6" />
        </button>

        {{-- NEXT ARROW --}}
        <button
            @click="nextSlide()"
            type="button"
            aria-label="Slide berikutnya"
            class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-slate-900/60 text-white/80 border border-white/20 backdrop-blur-md shadow-lg transition hover:bg-white hover:text-slate-900 hover:scale-105"
        >
            <x-heroicon-o-chevron-right class="h-5 w-5 sm:h-6 sm:w-6" />
        </button>

        {{-- DOTS INDICATORS --}}
        <div class="absolute bottom-3 sm:bottom-4 left-0 right-0 z-20 flex items-center justify-center gap-2">
            @foreach($banners as $index => $banner)
                <button
                    @click="goTo({{ $index }})"
                    type="button"
                    :class="activeSlide === {{ $index }} ? 'w-8 bg-amber-400' : 'w-2.5 bg-white/40 hover:bg-white/70'"
                    class="h-2 rounded-full transition-all duration-300"
                    aria-label="Pindah ke slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif

</section>

{{-- STATS SECTION (Clean margin with no overlap issue) --}}
<section class="relative z-20 -mt-6 sm:-mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-document-text class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['documents']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Dokumen Ilmiah
                </p>
            </div>
        </div>

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-users class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['authors']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Penulis & Sivitas
                </p>
            </div>
        </div>

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-folder-open class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['categories']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Kategori Repositori
                </p>
            </div>
        </div>

        <div class="group rounded-2xl border border-slate-200/80 bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-4">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-2xl bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-200">
                <x-heroicon-o-arrow-down-tray class="h-6 w-6 sm:h-7 sm:w-7" />
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($stats['downloads']) }}
                </p>
                <p class="text-xs sm:text-sm font-medium text-slate-500">
                    Total Diunduh
                </p>
            </div>
        </div>

    </div>

</section>

{{-- LATEST DOCUMENTS SECTION --}}
<section class="py-16 sm:py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

            <div>
                <div class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-blue-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                    Publikasi Terbaru
                </div>

                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Dokumen & Riset Terkini
                </h2>

                <p class="text-sm sm:text-base text-slate-500 mt-1">
                    Koleksi karya ilmiah paling baru yang telah diverifikasi dan dipublikasikan.
                </p>
            </div>

            <a
                href="{{ route('documents.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-800 transition group self-start sm:self-auto"
            >
                <span>Lihat Semua Koleksi</span>
                <x-heroicon-o-arrow-right class="w-4 h-4 transition-transform group-hover:translate-x-1" />
            </a>

        </div>

        <div class="grid gap-5">

            @forelse($latestDocuments as $document)
                <x-document-list-item :document="$document" />
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 p-12 text-center bg-white">
                    <x-heroicon-o-document-magnifying-glass class="mx-auto h-12 w-12 text-slate-400" />
                    <h3 class="mt-2 text-sm font-bold text-slate-900">Belum ada dokumen</h3>
                    <p class="mt-1 text-sm text-slate-500">Silakan periksa kembali nanti.</p>
                </div>
            @endforelse

        </div>

    </div>

</section>

@endsection
