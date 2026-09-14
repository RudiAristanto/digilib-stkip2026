<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class UserDocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::query()
            ->with([
                'category',
                'author',
            ])
            ->where('user_id', auth()->id())

            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.documents.index', compact(
            'documents'
        ));
    }

    public function create()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('nama_kategori')
            ->get();

        $user = auth()->user();

        /*
        * Cari Author berdasarkan email user.
        * Jika belum ada, buat otomatis.
        */
        $author = Author::firstOrCreate(
            [
                'email' => $user->email,
            ],
            [
                'nama_penulis' => $user->name,
                'nim_nidn' => null,
                'status' => 'Mahasiswa',
            ]
        );

        return view('dashboard.documents.create', compact(
            'categories',
            'author'
        ));
    }

    public function edit(Document $document)
    {
        Gate::authorize('update', $document);

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('nama_kategori')
            ->get();

        return view('dashboard.documents.edit', compact(
            'document',
            'categories'
        ));
    }

    public function update(Request $request,Document $document) 
    {
        Gate::authorize('update', $document);

        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'tahun_terbit' => [
                'required',
                'integer',
                'min:1900',
                'max:' . now()->year,
            ],

            'kata_kunci' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'abstrak' => [
                'required',
                'string',
            ],

            'access_type' => [
                'required',
                'in:public,private',
            ],

            'file_pdf' => [
                'nullable',
                File::types(['pdf'])
                    ->max(50 * 1024),
            ],

            'cover' => [
                'nullable',
                File::image()
                    ->max(2 * 1024),
            ],
        ]);

        $data = [
            'category_id' => $validated['category_id'],
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul'])
                . '-' . Str::lower(Str::random(6)),
            'abstrak' => $validated['abstrak'],
            'kata_kunci' => $validated['kata_kunci'] ?? null,
            'tahun_terbit' => $validated['tahun_terbit'],
            'access_type' => $validated['access_type'],

            // Setelah revisi, kembali menunggu verifikasi admin.
            'status' => 'pending',
            'review_note' => null,
        ];

        if ($request->hasFile('file_pdf')) {

            if (
                $document->file_pdf
                && Storage::disk('public')->exists($document->file_pdf)
            ) {
                Storage::disk('public')->delete($document->file_pdf);
            }

            $data['file_pdf'] = $request
                ->file('file_pdf')
                ->store('documents', 'public');

            $data['file_size'] = $request
                ->file('file_pdf')
                ->getSize();
        }

        if ($request->hasFile('cover')) {

            if (
                $document->cover
                && Storage::disk('public')->exists($document->cover)
            ) {
                Storage::disk('public')->delete($document->cover);
            }

            $data['cover'] = $request
                ->file('cover')
                ->store('covers', 'public');
        }

        $document->update($data);

        return redirect()
            ->route('user.documents.index')
            ->with(
                'success',
                'Dokumen berhasil diperbarui dan menunggu verifikasi admin.'
            );
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $author = Author::firstOrCreate(
            [
                'email' => $user->email,
            ],
            [
                'nama_penulis' => $user->name,
                'nim_nidn' => null,
                'status' => 'Mahasiswa',
            ]
        );

        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'tahun_terbit' => [
                'required',
                'integer',
                'min:1900',
                'max:' . now()->year,
            ],

            'kata_kunci' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'abstrak' => [
                'required',
                'string',
            ],

            'access_type' => [
                'required',
                'in:public,private',
            ],

            'file_pdf' => [
                'required',
                File::types(['pdf'])
                    ->max(50 * 1024),
            ],

            'cover' => [
                'nullable',
                File::image()
                    ->max(2 * 1024),
            ],
        ]);

        $pdfPath = $request
            ->file('file_pdf')
            ->store('documents', 'public');

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request
                ->file('cover')
                ->store('covers', 'public');
        }

        Document::create([
            'user_id' => auth()->id(),

            'category_id' => $validated['category_id'],

            'author_id' => $author->id,

            'judul' => $validated['judul'],

            'slug' => Str::slug($validated['judul'])
                . '-' . Str::lower(Str::random(6)),

            'abstrak' => $validated['abstrak'],

            'kata_kunci' => $validated['kata_kunci'] ?? null,

            'tahun_terbit' => $validated['tahun_terbit'],

            'file_pdf' => $pdfPath,

            'cover' => $coverPath,

            'file_size' => $request
                ->file('file_pdf')
                ->getSize(),

            'bahasa' => 'Indonesia',

            'jumlah_download' => 0,

            'jumlah_view' => 0,

            'access_type' => $validated['access_type'],

            'status' => 'pending',
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Dokumen berhasil diunggah dan menunggu verifikasi admin.'
            );
    }
}