<article
    class="group relative overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-5 sm:p-6 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-blue-400 hover:shadow-lg"
>
    <div class="flex flex-col gap-4">

        {{-- Top: Category & Year --}}
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700 ring-1 ring-inset ring-blue-700/10">
                    {{ $document->category?->nama_kategori ?? 'Dokumen' }}
                </span>

                @if($document->studyProgram)
                    <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                        <x-heroicon-o-academic-cap class="h-3.5 w-3.5 text-slate-500" />
                        {{ $document->studyProgram->nama_prodi }}
                    </span>
                @endif
            </div>

            @if($document->tahun_terbit)
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-500 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-100">
                    <x-heroicon-o-calendar class="h-3.5 w-3.5" />
                    {{ $document->tahun_terbit }}
                </span>
            @endif
        </div>

        {{-- Title --}}
        <div>
            <h3 class="text-lg sm:text-xl font-bold tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors duration-200">
                <a href="{{ route('documents.show', $document) }}" class="focus:outline-none">
                    {{ $document->judul }}
                </a>
            </h3>

            {{-- Author info --}}
            @if($document->author)
                <div class="mt-2.5 flex items-center gap-2.5">
                    @if($document->author->foto_url)
                        <img
                            src="{{ $document->author->foto_url }}"
                            alt="{{ $document->author->nama_penulis }}"
                            class="h-7 w-7 rounded-full object-cover ring-2 ring-white shadow-sm"
                            loading="lazy"
                        >
                    @else
                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                            {{ mb_substr($document->author->nama_penulis, 0, 1) }}
                        </div>
                    @endif

                    <span class="text-xs sm:text-sm font-medium text-slate-600">
                        {{ $document->author->nama_penulis }}
                    </span>

                    @if($document->author->status)
                        <span class="text-[11px] font-semibold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full">
                            {{ $document->author->status }}
                        </span>
                    @endif
                </div>
            @endif
        </div>

        {{-- Abstract snippet --}}
        @if($document->abstrak)
            <p class="text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed">
                {{ Str::limit(strip_tags($document->abstrak), 200) }}
            </p>
        @endif

        {{-- Footer actions & stats --}}
        <div class="mt-2 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">
            <div class="flex items-center gap-4 text-xs font-semibold text-slate-400">
                <span class="inline-flex items-center gap-1.5" title="Dilihat">
                    <x-heroicon-o-eye class="h-4 w-4 text-slate-400" />
                    {{ number_format($document->jumlah_view ?? 0) }}
                </span>

                <span class="inline-flex items-center gap-1.5" title="Diunduh">
                    <x-heroicon-o-arrow-down-tray class="h-4 w-4 text-slate-400" />
                    {{ number_format($document->jumlah_download ?? 0) }}
                </span>
            </div>

            <a
                href="{{ route('documents.show', $document) }}"
                class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-blue-600 hover:text-blue-800 transition"
            >
                <span>Lihat Detail</span>
                <x-heroicon-o-arrow-right class="h-4 w-4 transition-transform group-hover:translate-x-1" />
            </a>
        </div>

    </div>
</article>