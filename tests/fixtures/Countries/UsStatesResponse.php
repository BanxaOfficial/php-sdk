<?php

namespace Tests\fixtures\Countries;

class UsStatesResponse
{
    public static function get(): string
    {
        return json_encode([
            'data' => [
                'states' => [
                    [
                        "state_code" => "AL",
                        "state_name" => "Alabama",
                    ]
                ]
            ]
        ]);
    }
}


