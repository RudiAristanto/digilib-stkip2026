<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\Author;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    
    public function index(Request $request)
    {
        $documents = Document::query()
            ->with([
                'author',
                'category',
            ])
            ->where('status', 'published')

            // SEARCH
            ->when($request->search, function ($query, $search) {

                $query->where(function ($query) use ($search) {

                    $query->where('judul', 'like', "%{$search}%")
                        ->orWhere('kata_kunci', 'like', "%{$search}%")
                        ->orWhere('abstrak', 'like', "%{$search}%")

                        // Cari berdasarkan nama penulis
                        ->orWhereHas('author', function ($query) use ($search) {
                            $query->where(
                                'nama_penulis',
                                'like',
                                "%{$search}%"
                            );
                        })

                        // Opsional: cari kategori juga
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where(
                                'nama_kategori',
                                'like',
                                "%{$search}%"
                            );
                        });

                });

            })

            // FILTER KATEGORI
            ->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })

            // FILTER PENULIS
            ->when($request->author, function ($query, $author) {
                $query->where('author_id', $author);
            })

            // FILTER TAHUN
            ->when($request->tahun, function ($query, $tahun) {
                $query->where('tahun_terbit', $tahun);
            })

            // SORT
            ->when(
                $request->sort === 'oldest',
                fn ($query) => $query->oldest()
            )

            ->when(
                $request->sort === 'popular',
                fn ($query) => $query->orderByDesc('jumlah_download')
            )

            ->when(
                $request->sort === 'views',
                fn ($query) => $query->orderByDesc('jumlah_view')
            )

            ->when(
                ! $request->sort || $request->sort === 'latest',
                fn ($query) => $query->latest()
            )

            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | FILTER DATA
        |--------------------------------------------------------------------------
        */

        $categories = Category::query()
            ->whereHas('documents', function ($query) {
                $query->where('status', 'published');
            })
            ->orderBy('nama_kategori')
            ->get();


        $authors = Author::query()
            ->whereHas('documents', function ($query) {
                $query->where('status', 'published');
            })
            ->orderBy('nama_penulis')
            ->get();


        $years = Document::query()
            ->where('status', 'published')
            ->whereNotNull('tahun_terbit')
            ->select('tahun_terbit')
            ->distinct()
            ->orderByDesc('tahun_terbit')
            ->pluck('tahun_terbit');


        return view('documents.index', compact(
            'documents',
            'categories',
            'authors',
            'years'
        ));
    }

    public function show(Document $document)
    {
        $document->load([
            'author',
            'category',
            'user',
        ]);

        abort_unless(
            $document->status === 'published',
            404
        );

        $relatedDocuments = Document::query()
            ->with([
                'author',
                'category',
            ])
            ->where('status', 'published')
            ->where('category_id', $document->category_id)
            ->whereKeyNot($document->id)
            ->latest()
            ->take(4)
            ->get();

        return view('documents.show', compact(
            'document',
            'relatedDocuments'
        ));
    }
}