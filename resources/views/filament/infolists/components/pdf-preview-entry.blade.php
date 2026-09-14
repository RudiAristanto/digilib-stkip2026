<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">

    @php
        $record = $getRecord();
    @endphp

    @if($record->file_pdf)

        <iframe
            src="{{ asset('storage/'.$record->file_pdf) }}"
            width="100%"
            height="850"
            class="rounded-xl border"
        ></iframe>

    @else

        <div class="text-center text-gray-500 py-10">

            File PDF belum tersedia.

        </div>

    @endif

</x-dynamic-component>