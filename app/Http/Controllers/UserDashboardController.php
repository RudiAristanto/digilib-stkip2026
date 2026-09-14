<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $notifications = auth()->user()
        ->notifications()
        ->latest()
        ->take(5)
        ->get();

        $stats = [
            'total' => Document::where('user_id', $userId)->count(),

            'pending' => Document::where('user_id', $userId)
                ->where('status', 'pending')
                ->count(),

            'published' => Document::where('user_id', $userId)
                ->where('status', 'published')
                ->count(),

            'rejected' => Document::where('user_id', $userId)
                ->where('status', 'rejected')
                ->count(),

            'downloads' => Document::where('user_id', $userId)
                ->sum('jumlah_download'),
        ];

        $latestDocuments = Document::query()
            ->with(['category', 'author'])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'latestDocuments',
            'notifications'
        ));
    }

    public function downloads()
    {
        $downloads = \App\Models\Download::query()
            ->with([
                'document.author',
                'document.category',
            ])
            ->where('user_id', auth()->id())
            ->latest('downloaded_at')
            ->paginate(10);

        return view('dashboard.downloads', compact(
            'downloads'
        ));
    }
}