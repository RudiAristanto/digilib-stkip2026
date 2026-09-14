<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    // public function index()
    // {
    //     $authors = Author::query()
    //         ->withCount([
    //             'documents' => function ($query) {
    //                 $query->where('status', 'published');
    //             },
    //         ])
    //         ->orderBy('nama_penulis')
    //         ->paginate(20);

    //     return view('authors.index', compact('authors'));
    // }

    // public function show(Author $author)
    // {
    //     $documents = $author->documents()
    //         ->with(['author', 'category'])
    //         ->where('status', 'published')
    //         ->latest()
    //         ->paginate(10);

    //     return view('authors.show', compact(
    //         'author',
    //         'documents'
    //     ));
    // }
}