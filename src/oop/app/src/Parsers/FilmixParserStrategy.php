<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface
{
    /**
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        preg_match('#<h1 class="name" itemprop="name">(.+?)</h1>#', $siteContent, $title);
        preg_match('#<img src="(.+?)" class="poster poster-tooltip"#', $siteContent, $poster);
        preg_match('#<div class="full-story">(.+?)</div>#', $siteContent, $description);

        return (new Movie())->setData($title[1], $poster[1], $description[1]);
    }
}
