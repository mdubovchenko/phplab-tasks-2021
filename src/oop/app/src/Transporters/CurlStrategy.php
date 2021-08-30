<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function getContent(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $siteContent = curl_exec($ch);
        curl_close($ch);

        return mb_convert_encoding($siteContent, "UTF-8", "Windows-1251");
    }
}
