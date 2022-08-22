<?php

namespace Tests\fixtures\PaymentMethods;

class PaymentMethodResponse
{
    public static function get(): string
    {
        return json_encode([
                'data' => [
                    'payment_methods' =>
                        [
                            "id"                 => 6003,
                            "paymentType"        => "POLI",
                            "name"               => "POLi",
                            "description"        => "POLi Payments allow you to buy digital currency by bank transfer using your internet banking",
                            "logo_url"           => "https=>//api.banxa-sandbox.com/images/payment-providers/poli.png",
                            "status"             => "ACTIVE",
                            "supported_agents"   => null,
                            "type"               => "FIAT_TO_CRYPTO",
                            "supported_fiat"     => [
                                "AUD"
                            ],
                            "supported_coin"     => [
                                "BTC",
                                "ETH",
                                "USDT",
                                "BUSD",
                                "BNB",
                                "BCH",
                                "LINK",
                                "LTC",
                                "XRP",
                                "EOS",
                                "USDC",
                                "BSV",
                                "BAT",
                                "MANA",
                                "AVAX",
                                "COMP",
                                "DAI",
                                "XLM",
                                "AXS",
                                "SUSD",
                                "USDP",
                                "APE",
                                "HBAR",
                                "LUNA",
                                "UST",
                                "WAXP",
                                "SOLO"
                            ],
                            "transaction_fees"   => [
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "BTC",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "ETH",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "USDT",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "BUSD",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "BNB",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "BCH",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "LINK",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "LTC",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "XRP",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "EOS",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "USDC",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "BSV",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "BAT",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "MANA",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "AVAX",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "COMP",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "DAI",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "XLM",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "AXS",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "SUSD",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "USDP",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "APE",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "HBAR",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "LUNA",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "UST",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "WAXP",
                                    "fees"      => []
                                ],
                                [
                                    "fiat_code" => "AUD",
                                    "coin_code" => "SOLO",
                                    "fees"      => []
                                ]
                            ],
                            "transaction_limits" => [
                                [
                                    "fiat_code" => "AUD",
                                    "min"       => "10",
                                    "max"       => "15000"
                                ]
                            ]

                        ]
                ]
            ]
        );
    }
}


