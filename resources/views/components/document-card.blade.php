<div
    class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

    <div class="aspect-[3/4] bg-gray-100">

        @if($document->cover)

            <img
                src="{{ Storage::url($document->cover) }}"
                class="w-full h-full object-cover">

        @else

            <div
                class="w-full h-full flex items-center justify-center text-gray-400">

                No Cover

            </div>

        @endif

    </div>

    <div class="p-5">

        <span
            class="inline-block px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">

            {{ $document->category->nama_kategori }}

        </span>

        <h3
            class="mt-4 font-bold line-clamp-2 text-lg">

            {{ $document->judul }}

        </h3>

        <div class="mt-4 space-y-2 text-sm text-gray-500">

            <div>

                👤 {{ $document->author->nama }}

            </div>

            <div>

                📅 {{ $document->tahun_terbit }}

            </div>

            <div class="flex justify-between">

                <span>

                    👁 {{ number_format($document->jumlah_view) }}

                </span>

                <span>

                    ⬇ {{ number_format($document->jumlah_download) }}

                </span>

            </div>

        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">

            <a
                href="{{ route('documents.show',$document) }}"
                class="text-center py-2 rounded-lg bg-gray-100 hover:bg-gray-200">

                Detail

            </a>

            <a
                href="{{ route('documents.read',$document) }}"
                class="text-center py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                Baca

            </a>

        </div>

    </div>

</div>