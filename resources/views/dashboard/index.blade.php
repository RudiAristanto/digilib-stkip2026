@extends('layouts.app')

@section('title', 'Dashboard - DIGILIB STKIP')

@section('content')

<section class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-8 flex items-center justify-between">

    <div>

        <h1 class="text-3xl font-bold text-slate-900">
            Dashboard Saya
        </h1>

        <p class="mt-2 text-slate-500">
            Kelola dan pantau dokumen yang Anda unggah.
        </p>

    </div>

    <div class="flex gap-3">

        <a
            href="{{ route('user.documents.index') }}"
            class="rounded-xl border border-blue-700 px-5 py-3 font-semibold text-blue-700 hover:bg-blue-50"
        >
            Dokumen Saya
        </a>

        <a
            href="{{ route('user.downloads') }}"
            class="inline-flex items-center gap-2 rounded-xl
                border border-slate-300 bg-white px-5 py-3
                font-semibold text-slate-700
                hover:bg-slate-50"
        >
            <x-heroicon-o-arrow-down-tray class="w-5 h-5" />

            Riwayat Download
        </a>

        <a
            href="{{ route('user.documents.create') }}"
            class="rounded-xl bg-blue-700 px-5 py-3 font-semibold text-white hover:bg-blue-800"
        >
            Upload Dokumen
        </a>

    </div>

</div>


        {{-- Statistik --}}
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-5">

            <div class="rounded-2xl bg-white border border-slate-200 p-5">
                <p class="text-sm text-slate-500">Total Dokumen</p>

                <h2 class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $stats['total'] }}
                </h2>
            </div>


            <div class="rounded-2xl bg-white border border-slate-200 p-5">
                <p class="text-sm text-slate-500">Pending</p>

                <h2 class="mt-2 text-3xl font-bold text-amber-600">
                    {{ $stats['pending'] }}
                </h2>
            </div>


            <div class="rounded-2xl bg-white border border-slate-200 p-5">
                <p class="text-sm text-slate-500">Published</p>

                <h2 class="mt-2 text-3xl font-bold text-emerald-600">
                    {{ $stats['published'] }}
                </h2>
            </div>


            <div class="rounded-2xl bg-white border border-slate-200 p-5">
                <p class="text-sm text-slate-500">Rejected</p>

                <h2 class="mt-2 text-3xl font-bold text-red-600">
                    {{ $stats['rejected'] }}
                </h2>
            </div>


            <div class="rounded-2xl bg-white border border-slate-200 p-5">
                <p class="text-sm text-slate-500">Total Download</p>

                <h2 class="mt-2 text-3xl font-bold text-blue-700">
                    {{ number_format($stats['downloads']) }}
                </h2>
            </div>

        </div>

        <div class="mt-10">

    <h2 class="text-2xl font-bold text-slate-900">
        Notifikasi
    </h2>

    <div class="mt-5 overflow-hidden rounded-2xl border border-slate-200 bg-white">

        @forelse($notifications as $notification)

            <div class="border-b border-slate-200 p-5 last:border-b-0">

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <h3 class="font-semibold text-slate-900">
                            {{ $notification->data['judul'] }}
                        </h3>

                        @if($notification->data['status'] === 'published')

                            <p class="mt-1 text-sm text-emerald-600">
                                Dokumen Anda telah disetujui dan dipublikasikan.
                            </p>

                        @elseif($notification->data['status'] === 'rejected')

                            <p class="mt-1 text-sm text-red-600">
                                Dokumen Anda ditolak.
                            </p>

                            @if(!empty($notification->data['review_note']))
                                <p class="mt-2 text-sm text-slate-600">
                                    Catatan admin:
                                    {{ $notification->data['review_note'] }}
                                </p>
                            @endif

                        @endif

                    </div>

                    <span class="text-xs text-slate-400">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>

                </div>

            </div>

        @empty

            <div class="p-8 text-center text-slate-500">
                Belum ada notifikasi.
            </div>

        @endforelse

    </div>

</div>


        {{-- Dokumen terbaru --}}
        <div class="mt-10">

            <div class="mb-5 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-slate-900">
                        Dokumen Terbaru Saya
                    </h2>

                    <p class="mt-1 text-slate-500">
                        Dokumen yang terakhir Anda unggah.
                    </p>

                </div>

            </div>


            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                @forelse($latestDocuments as $document)

                    <div class="flex items-center justify-between gap-5 border-b border-slate-200 p-5 last:border-b-0">

                        <div>

                            <h3 class="font-semibold text-slate-900">
                                {{ $document->judul }}
                            </h3>

                            <div class="mt-2 flex flex-wrap gap-3 text-sm text-slate-500">

                                <span>
                                    {{ $document->category?->nama_kategori }}
                                </span>

                                <span>•</span>

                                <span>
                                    {{ $document->tahun_terbit }}
                                </span>

                            </div>

                        </div>


                        <span
                            class="rounded-full px-3 py-1 text-sm font-semibold
                            @if($document->status === 'published')
                                bg-emerald-100 text-emerald-700
                            @elseif($document->status === 'pending')
                                bg-amber-100 text-amber-700
                            @elseif($document->status === 'rejected')
                                bg-red-100 text-red-700
                            @else
                                bg-slate-100 text-slate-600
                            @endif">

                            {{ ucfirst($document->status) }}

                        </span>

                    </div>

                @empty

                    <div class="p-10 text-center text-slate-500">
                        Anda belum memiliki dokumen.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</section>

@endsection