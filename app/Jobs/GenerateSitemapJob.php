<?php

namespace App\Jobs;

use App\Observers\SitemapObserver;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Spatie\Crawler\Crawler;
use SimpleXMLElement;

class GenerateSitemapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }
    public function handle()
    {
        $sitemap = new SimpleXMLElement('<urlset/>');
        Crawler::create()
            ->setCrawlObserver(new SitemapObserver($sitemap))
            ->setMaximumDepth(10)
            ->setTotalCrawlLimit(500)
            ->startCrawling($this->url);
        Cache::put('sitemap_status', 'done', now()->addMinutes(10));
    }
}
