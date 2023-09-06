<?php

namespace System\Traits;

trait ResponseTrait{

    public static function response(array $data, int $statusCode, string $message)
    {
        return json_encode([
            'data' =>  $data,
            'statusCode' => $statusCode,
            'message' => $message
        ]);
    }

}