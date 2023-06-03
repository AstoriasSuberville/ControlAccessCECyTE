<?php

class Str
{
    public static function rand_string($len = 12): string
    {
        return substr(base64_encode(random_bytes($len)), 0, $len);
    }

    public static function upper(string $text): string
    {
        return strtoupper($text);
    }

    public static function lower(string $text): string
    {
        return strtolower($text);
    }

    public static function first(string $text): string
    {
        return ucfirst(self::lower($text));
    }

    public static function capitalize(string $len): string
    {
        return ucwords(self::lower($len));
    }
}
