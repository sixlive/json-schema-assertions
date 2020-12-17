<?php

namespace sixlive\JsonSchemaAssertions\Support;

class Str
{
    /**
     * @param  string  $string
     * @return bool
     */
    public static function isJson(string $string): bool
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
