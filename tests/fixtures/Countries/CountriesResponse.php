<?php

namespace Tests\fixtures\Countries;

class CountriesResponse
{
    public static function get(): string
    {
        return json_encode([
            'data' => [
                'countries' => [
                    [
                        "country_code" => "AU",
                        "country_name" => "Australia",
                    ]
                ]
            ]
        ]);
    }

}


