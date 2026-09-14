<article
    class="bg-white rounded-2xl border border-gray-200 hover:border-blue-500 hover:shadow-lg transition duration-300 overflow-hidden">

    <div class="flex">

        {{-- Cover --}}
        <!-- <div class="w-40 shrink-0">

            @if($document->cover)

                <img
                    src="{{ Storage::url($document->cover) }}"
                    class="w-full h-full object-cover">

            @else

                <div
                    class="w-full h-full min-h-[220px] bg-gray-100 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-14 h-14 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 6v12m6-6H6"/>

                    </svg>

                </div>

            @endif

        </div> -->

        {{-- Content --}}
        <div class="flex-1 p-6">

            <div class="flex justify-between">

                <div>

                    <span
                        class="inline-flex bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">

                        {{ $document->category->nama_kategori }}

                    </span>

                    <h2 class="mt-3 text-2xl font-bold">
                        <a
                            href="{{ route('documents.show', $document) }}"
                            class="text-gray-900 hover:text-blue-700 transition-colors duration-200 cursor-pointer"
                        >
                            {{ $document->judul }}
                        </a>
                    </h2>

                </div>

                <span
                    class="text-sm text-gray-500 whitespace-nowrap">

                    {{ $document->tahun_terbit }}

                </span>

            </div>

            <div class="mt-3 text-gray-500 flex items-center gap-1.5">

                <x-heroicon-o-user class="w-4 h-4" />
                <span>{{ $document->author->nama_penulis }}</span>

            </div>

            <p
                class="mt-5 text-gray-600 leading-7 line-clamp-3">

                {{ Str::limit(strip_tags($document->abstrak),220) }}

            </p>

            <div
                class="mt-6 flex justify-between items-center">

                <div
                    class="flex gap-6 text-sm text-gray-500">

                    <span class="mt-3 text-gray-500 flex items-center gap-1.5">

                        <x-heroicon-o-eye class="w-4 h-4" />
                        {{ number_format($document->jumlah_view) }}

                    </span>

                    <span class="mt-3 text-gray-500 flex items-center gap-1.5">

                        <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                        {{ number_format($document->jumlah_download) }}

                    </span>

                </div>

                <a
                    href="{{ route('documents.show',$document) }}"
                    class="font-semibold text-blue-700 hover:text-blue-900 mt-3 flex items-center gap-1.5">

                    Lihat Detail <x-heroicon-o-arrow-right-circle class="w-4 h-4" />

                </a>

            </div>

        </div>

    </div>

</article>