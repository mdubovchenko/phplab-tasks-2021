<?php

namespace src\oop\app\src\Parsers;

use Symfony\Component\DomCrawler\Crawler;
use src\oop\app\src\Models\Movie;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    /**
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        $crawler = new Crawler($siteContent);
        $title = $crawler->filter('.ftitle h1')->text();
        $poster = $crawler->filter('.fposter a')->link()->getUri();
        $description = $crawler->filter('.fdesc.full-text')->text();

        return new Movie($title, $poster, $description);
    }
}
