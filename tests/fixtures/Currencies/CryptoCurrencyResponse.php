<?php

namespace Tests\fixtures\Currencies;

class CryptoCurrencyResponse
{
    public static function get(): string
    {
        return json_encode([
            'data' => [
                'coins' => [
                    "coin_code"   => "BTC",
                    "coin_name"   => "Bitcoin",
                    "blockchains" => [
                        [
                            "code"        => "BTC",
                            "description" => "Bitcoin",
                            "is_default"  => true
                        ]
                    ]
                ]
            ]
        ]);
    }
}


