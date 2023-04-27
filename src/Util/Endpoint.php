<?php

namespace Ay4t\PHPExpedisi\Util;

class Endpoint
{

    /**
     * @var string
     */
    private $baseUrl;

    public static function baseUrl()
    {
        return self::$baseUrl;
    }

    public static function setBaseUrl(string $baseUrl)
    {
        self::$baseUrl = $baseUrl;
    }
}
