<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\News;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function news()
    {
        $news = News::latest()->get();
        return response()->json($news);
    }

    public function newsItem($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news);
    }

    public function announcements()
    {
        $announcements = Announcement::where(function($query) {
            $query->where('expires_at', '>=', now())
                ->orWhereNull('expires_at');
        })->latest()->get();

        return response()->json($announcements);
    }

    public function announcementItem($id)
    {
        $announcement = Announcement::findOrFail($id);
        return response()->json($announcement);
    }
}
