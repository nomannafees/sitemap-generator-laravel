<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        Cache::put('sitemap_status', 'running', now()->addMinutes(10));
        dispatch(new \App\Jobs\GenerateSitemapJob($request->url));
        return response()->json(['message' => 'Sitemap generation started!']);
    }

    public function download()
    {
        if (Cache::get('sitemap_status') !== 'done') {
            return response()->json(['error' => 'Sitemap is still being generated. Try again later.'], 400);
        }
        $filePath = storage_path('app/public/sitemap.xml');
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Sitemap not found'], 404);
        }
        return response()->download($filePath, 'sitemap.xml');
    }

    public function checkStatus()
    {
        $status = Cache::get('sitemap_status', 'running');
        return response()->json(['status' => $status]);
    }

}
