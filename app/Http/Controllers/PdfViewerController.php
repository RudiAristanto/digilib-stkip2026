<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfViewerController extends Controller
{
    public function show(Document $document)
    {
        abort_unless(
            $document->status === 'published',
            404
        );

        if (
            $document->access_type === 'private'
            && ! auth()->check()
        ) {
            abort(403);
        }

        $disk = Storage::disk('public');

        abort_unless(
            $disk->exists($document->file_pdf),
            404,
            'File PDF tidak ditemukan.'
        );

        $document->increment('jumlah_view');

        $pdfUrl = route('documents.stream', $document);

        return view('pdf.viewer', compact(
            'document',
            'pdfUrl'
        ));
    }

    public function stream(Document $document)
    {
        abort_unless(
            $document->status === 'published',
            404
        );

        if (
            $document->access_type === 'private'
            && ! auth()->check()
        ) {
            abort(403);
        }

        $disk = Storage::disk('public');

        abort_unless(
            $disk->exists($document->file_pdf),
            404,
            'File PDF tidak ditemukan.'
        );

        return response()->file(
            $disk->path($document->file_pdf),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline',
            ]
        );
    }

    public function download(
        Request $request,
        Document $document
    ) {
        abort_unless(
            $document->status === 'published',
            404
        );

        if (
            $document->access_type === 'private'
            && ! auth()->check()
        ) {
            abort(403);
        }

        $disk = Storage::disk('public');

        abort_unless(
            $disk->exists($document->file_pdf),
            404,
            'File PDF tidak ditemukan.'
        );

        $document->increment('jumlah_download');

        Download::create([
            'document_id'   => $document->id,
            'user_id'       => auth()->id(),
            'ip_address'    => $request->ip(),
            'downloaded_at' => now(),
        ]);

        return $disk->download(
            $document->file_pdf,
            Str::slug($document->judul) . '.pdf'
        );
    }
}