<?php

namespace Duoporta\Utils;

use Duoporta\Exceptions\JsonDecodeError;
use function json_decode;
use const JSON_ERROR_NONE;
use function json_last_error;

class JsonParser
{
    public static function decode($data)
    {
        $result = json_decode($data);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonDecodeError;
        }

        return $result;
    }
}
