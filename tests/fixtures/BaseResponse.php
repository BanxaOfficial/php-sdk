<?php

namespace Tests\fixtures;

class BaseResponse
{
    public static function serverError(): string
    {
        return json_encode([
            "errors" => [
                [
                    "status" => 500,
                    "code"   => 0,
                    "title"  => "Internal Server Error."
                ]
            ]
        ]);
    }
}