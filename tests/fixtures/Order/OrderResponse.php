<?php

namespace Tests\fixtures\Order;

class OrderResponse
{
    public static function getOrder(): string
    {
        return json_encode([
                'data' => [
                    'order' =>
                        [
                            "id"                  => "84cecea94e3b8c08386623e46503aebc",
                            "account_id"          => "69f4042e7d82a064ae63ecb79e13e166",
                            "account_reference"   => "test-init-order-3xxxx",
                            "order_type"          => "CRYPTO-BUY",
                            "payment_type"        => null,
                            "ref"                 => null,
                            "fiat_code"           => "AUD",
                            "fiat_amount"         => 100,
                            "coin_code"           => "BTC",
                            "coin_amount"         => 0,
                            "wallet_address"      => "0x56c386b7b49be8618dbcdb2c6d09e161645c31ed",
                            "wallet_address_tag"  => null,
                            "fee"                 => null,
                            "fee_tax"             => null,
                            "payment_fee"         => null,
                            "payment_fee_tax"     => null,
                            "commission"          => null,
                            "tx_hash"             => null,
                            "tx_confirms"         => null,
                            "created_date"        => "13-Nov-2020",
                            "created_at"          => "13-Nov-2020 03:16:35",
                            "status"              => "expired",
                            "completed_at"        => null,
                            "merchant_fee"        => null,
                            "merchant_commission" => null,
                            "meta_data"           => null,
                            "blockchain"          => [
                                [
                                    "id"          => 1,
                                    "code"        => "BTC",
                                    "description" => "Bitcoin"
                                ]
                            ]

                        ]
                ]
            ]
        );
    }


    public static function postOrder(): string
    {
        return json_encode([
                'data' => [
                    'order' =>
                        [
                            "id"                  => "84cecea94e3b8c08386623e46503aebc",
                            "account_id"          => "69f4042e7d82a064ae63ecb79e13e166",
                            "account_reference"   => "test-init-order-3xxxx",
                            "order_type"          => "CRYPTO-BUY",
                            "payment_type"        => null,
                            "ref"                 => null,
                            "fiat_code"           => "AUD",
                            "fiat_amount"         => 100,
                            "coin_code"           => "BTC",
                            "coin_amount"         => 0,
                            "wallet_address"      => "0x56c386b7b49be8618dbcdb2c6d09e161645c31ed",
                            "wallet_address_tag"  => null,
                            "fee"                 => null,
                            "fee_tax"             => null,
                            "payment_fee"         => null,
                            "payment_fee_tax"     => null,
                            "commission"          => null,
                            "tx_hash"             => null,
                            "tx_confirms"         => null,
                            "created_date"        => "13-Nov-2020",
                            "created_at"          => "13-Nov-2020 03:16:35",
                            "status"              => "expired",
                            "completed_at"        => null,
                            "merchant_fee"        => null,
                            "merchant_commission" => null,
                            "meta_data"           => null,
                            "blockchain"          => [
                                [
                                    "id"          => 1,
                                    "code"        => "BTC",
                                    "description" => "Bitcoin"
                                ]
                            ]

                        ]
                ]
            ]
        );
    }

    public static function getOrders(): string
    {
        return json_encode([
                'data' => [
                    'order' =>
                        [
                            "id"                  => "84cecea94e3b8c08386623e46503aebc",
                            "account_id"          => "69f4042e7d82a064ae63ecb79e13e166",
                            "account_reference"   => "test-init-order-3xxxx",
                            "order_type"          => "CRYPTO-BUY",
                            "payment_type"        => null,
                            "ref"                 => null,
                            "fiat_code"           => "AUD",
                            "fiat_amount"         => 100,
                            "coin_code"           => "BTC",
                            "coin_amount"         => 0,
                            "wallet_address"      => "0x56c386b7b49be8618dbcdb2c6d09e161645c31ed",
                            "wallet_address_tag"  => null,
                            "fee"                 => null,
                            "fee_tax"             => null,
                            "payment_fee"         => null,
                            "payment_fee_tax"     => null,
                            "commission"          => null,
                            "tx_hash"             => null,
                            "tx_confirms"         => null,
                            "created_date"        => "13-Nov-2020",
                            "created_at"          => "13-Nov-2020 03:16:35",
                            "status"              => "expired",
                            "completed_at"        => null,
                            "merchant_fee"        => null,
                            "merchant_commission" => null,
                            "meta_data"           => null,
                            "blockchain"          => [
                                [
                                    "id"          => 1,
                                    "code"        => "BTC",
                                    "description" => "Bitcoin"
                                ]
                            ]

                        ]
                ],
                'meta' => [
                    'current_page' => 1,
                    "from"         => 1,
                    "last_page"    => 1,
                    "per_page"     => "5",
                    "to"           => 1,
                    "total"        => 1
                ]
            ]
        );
    }

    public static function createOrder(): string
    {
        return json_encode([
                'data' => [
                    'order' =>
                        [
                            "id"                => "ef351249fb851e2f82db266369c81fb1",
                            "account_id"        => "78bd96f3737bb61d8d2499ea1135c167",
                            "account_reference" => "testing001",
                            "order_type"        => "CRYPTO-BUY",
                            "fiat_code"         => "AUD",
                            "fiat_amount"       => 100,
                            "coin_code"         => "ETH",
                            "wallet_address"    => "0x556f6825bac6c21d7a967eee49d3330b37201eb1",
                            "payment_id"        => 6003,
                            "payment_code"      => "POLI",
                            "blockchain"        => [
                                "id"          => 3,
                                "code"        => "ETH",
                                "description" => "Ethereum (ERC-20)",
                            ],
                            "created_at"        => "15-Aug-2022 00:58:59",
                            "checkout_url"      => "https://cremorne.banxa-sandbox.com?expires=1660525199&id=cc1ff825-bf65-40b5-a3c6-f68b72b89a98&oid=ef351249fb851e2f82db266369c81fb1&signature=013e74df2b6496729bae1f3b77fbf7182f89b070fea2b15e02624f19bf103088"
                        ]
                ]
            ]
        );
    }
}


