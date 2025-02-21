<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        dispatch(new \App\Jobs\GenerateSitemapJob($request->url));
        return redirect()->back()->with('success', 'Sitemap generation started! Please check back later.');
    }

    public function download()
    {
        $filePath = 'sitemap.xml';

        if (!Storage::disk('public')->exists($filePath)) {
            return response()->json(['error' => 'Sitemap not found'], 404);
        }

        return response()->download(storage_path("app/public/$filePath"), 'sitemap.xml');
    }

}
