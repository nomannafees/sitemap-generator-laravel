<?php

namespace App\Observers;

use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\ResponseInterface;

class SitemapObserver extends CrawlObserver
{
    protected $sitemap;
    protected $visitedUrls = [];

    public function __construct()
    {
        $this->sitemap = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
    }

    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null, ?string $linkText = null): void
    {
        $urlString = (string)$url;
        if (!in_array($urlString, $this->visitedUrls)) {
            $this->visitedUrls[] = $urlString;
            $urlElement = $this->sitemap->addChild('url');
            $urlElement->addChild('loc', htmlspecialchars($urlString));
            $urlElement->addChild('lastmod', date(DATE_W3C));
            $urlElement->addChild('priority', '0.8');
        }
    }

    public function finishedCrawling(): void
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->sitemap->asXML());
        file_put_contents(storage_path('app/public/sitemap.xml'), $dom->saveXML());
    }
}
