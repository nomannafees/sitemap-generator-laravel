<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/generate-sitemap', [SitemapController::class, 'generate'])->name('generate.sitemap');
Route::get('/download-sitemap', [SitemapController::class, 'download'])->name('download.sitemap');
