<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitemapController::class, 'index']);
Route::get('/check-sitemap-status', [SitemapController::class, 'checkStatus'])->name('check.sitemap.status');
Route::post('/generate-sitemap', [SitemapController::class, 'generate'])->name('generate.sitemap');
Route::get('/download-sitemap', [SitemapController::class, 'download'])->name('download.sitemap');
