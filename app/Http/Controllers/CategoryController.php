<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withCount([
                'documents' => function ($query) {
                    $query->where('status', 'published');
                },
            ])
            ->orderBy('nama_kategori')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $documents = $category->documents()
            ->with(['author', 'category'])
            ->where('status', 'published')
            ->latest()
            ->paginate(10);

        return view('categories.show', compact(
            'category',
            'documents'
        ));
    }
}