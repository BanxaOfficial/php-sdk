<?php

namespace Tests\fixtures\Currencies;

class FiatResponse
{
    public static function get(): string
    {
        return json_encode([
            'data' => [
                'fiats' => [
                    [
                        "fiat_code"   => "AED",
                        "fiat_name"   => "United Arab Emirates Dirham",
                        "fiat_symbol" => "AED",
                    ]
                ]
            ]
        ]);
    }
}


