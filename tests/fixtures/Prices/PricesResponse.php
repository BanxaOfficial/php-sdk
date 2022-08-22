<?php

namespace Tests\fixtures\Prices;

class PricesResponse
{
    public static function get(): string
    {
        return json_encode([
            'data' => [
                'spot_price' => "27381.01",
                'prices'     => [
                    [
                        "payment_method_id"        => 6042,
                        "type"                     => "FIAT_TO_CRYPTO",
                        "spot_price_fee"           => "15.00",
                        "spot_price_including_fee" => "27710.30",
                        "coin_amount"              => "1.00000000",
                        "coin_code"                => "BTC",
                        "fiat_amount"              => "27710.30",
                        "fiat_code"                => "USD",
                        "fee_amount"               => "15.00",
                        "network_fee"              => "0.00"
                    ]
                ]
            ]
        ]);
    }
}


