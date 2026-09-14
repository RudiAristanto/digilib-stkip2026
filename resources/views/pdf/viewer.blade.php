<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $document->judul }} - DIGILIB STKIP</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-stkip.png') }}"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
        }

        .viewer-page {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100vh;
        }

        /* =========================
           HEADER
        ========================= */

        .viewer-header {
            flex-shrink: 0;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 24px;
        }

        .viewer-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .viewer-title {
            min-width: 0;
            flex: 1;
        }

        .viewer-title h1 {
            margin: 0;
            font-size: 20px;
            line-height: 1.4;
            font-weight: 600;
            color: #0f172a;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .viewer-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .viewer-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            padding: 9px 15px;
            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;

            text-decoration: none;

            transition: 0.2s;
        }

        .button-back {
            background: #2563eb;
            color: #ffffff;
        }

        .button-back:hover {
            background: #1d4ed8;
        }

        .button-download {
            background: #16a34a;
            color: #ffffff;
        }

        .button-download:hover {
            background: #15803d;
        }

        /* =========================
           METADATA
        ========================= */

        .viewer-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 26px;

            margin-top: 12px;

            font-size: 13px;
            color: #64748b;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .meta-label {
            color: #94a3b8;
            font-size: 11px;
        }

        .meta-value {
            color: #334155;
            font-weight: 600;
        }

        /* =========================
           PDF
        ========================= */

        .pdf-container {
            flex: 1;
            min-height: 0;
            width: 100%;
            overflow: hidden;
            background: #26272b;
        }

        .pdf-frame {
            display: block;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .viewer-header {
                padding: 12px 14px;
            }

            .viewer-header-top {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .viewer-title h1 {
                font-size: 16px;
                white-space: normal;

                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }

            .viewer-actions {
                width: 100%;
            }

            .viewer-button {
                flex: 1;
            }

            .viewer-meta {
                gap: 14px 20px;
            }
        }
    </style>

</head>

<body>

<div class="viewer-page">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}

    <header class="viewer-header">

        <div class="viewer-header-top">

            <div class="viewer-title">

                <h1 title="{{ $document->judul }}">
                    {{ $document->judul }}
                </h1>

            </div>


            <div class="viewer-actions">

                <a
                    href="{{ route('documents.show', $document) }}"
                    class="viewer-button button-back"
                >
                    ← Kembali
                </a>

                <a
                    href="{{ route('documents.download', $document) }}"
                    class="viewer-button button-download"
                >
                    Download PDF
                </a>

            </div>

        </div>


        {{-- Metadata --}}
        <div class="viewer-meta">

            <div class="meta-item">
                <span class="meta-label">
                    Kategori
                </span>

                <span class="meta-value">
                    {{ $document->category?->nama_kategori ?? '-' }}
                </span>
            </div>


            <div class="meta-item">
                <span class="meta-label">
                    Tahun
                </span>

                <span class="meta-value">
                    {{ $document->tahun_terbit ?? '-' }}
                </span>
            </div>


            <div class="meta-item">
                <span class="meta-label">
                    Bahasa
                </span>

                <span class="meta-value">
                    {{ $document->bahasa ?? 'Indonesia' }}
                </span>
            </div>


            <div class="meta-item">
                <span class="meta-label">
                    Ukuran
                </span>

                <span class="meta-value">
                    {{ $document->formatted_file_size }}
                </span>
            </div>


            <div class="meta-item">
                <span class="meta-label">
                    Dilihat
                </span>

                <span class="meta-value">
                    {{ number_format($document->jumlah_view) }}
                </span>
            </div>


            <div class="meta-item">
                <span class="meta-label">
                    Download
                </span>

                <span class="meta-value">
                    {{ number_format($document->jumlah_download) }}
                </span>
            </div>

        </div>

    </header>


    {{-- ========================= --}}
    {{-- PDF.JS --}}
    {{-- ========================= --}}

    <main class="pdf-container">

        <iframe
            class="pdf-frame"
            src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($pdfUrl) }}"
            allowfullscreen
        ></iframe>

    </main>

</div>

</body>
</html>