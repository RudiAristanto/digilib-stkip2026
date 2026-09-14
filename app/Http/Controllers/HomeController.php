<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Document;
use App\Models\UserGuide;

class HomeController extends Controller
{
    public function index()
    {
        $latestDocuments = Document::query()
            ->with([
                'author',
                'category',
            ])
            ->where('status', 'published')
            ->latest()
            ->take(8)
            ->get();

        $userGuides = UserGuide::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        $popularDocuments = Document::query()
            ->with([
                'author',
                'category',
            ])
            ->where('status', 'published')
            ->orderByDesc('jumlah_download')
            ->take(5)
            ->get();

        $categories = Category::query()
            ->withCount([
                'documents' => function ($query) {
                    $query->where('status', 'published');
                },
            ])
            ->orderByDesc('documents_count')
            ->take(8)
            ->get();

        $stats = [
            'documents' => Document::query()
                ->where('status', 'published')
                ->count(),

            'authors' => Author::query()
                ->whereHas('documents', function ($query) {
                    $query->where('status', 'published');
                })
                ->count(),

            'categories' => Category::query()
                ->whereHas('documents', function ($query) {
                    $query->where('status', 'published');
                })
                ->count(),

            'downloads' => Document::query()
                ->where('status', 'published')
                ->sum('jumlah_download'),
        ];

        return view('home', compact(
            'latestDocuments',
            'popularDocuments',
            'categories',
            'stats',
            'userGuides'
        ));
    }
}