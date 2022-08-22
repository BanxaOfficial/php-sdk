![Banxa](https://banxa.com/wp-content/uploads/2022/02/image-16.png)



## Banxa official PHP SDK
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/banxa-global/php-sdk/run-tests?label=tests)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/banxa/php-sdk.svg?style=flat-square)](https://packagist.org/packages/banxa/php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/banxa/php-sdk.svg?style=flat-square)](https://packagist.org/packages/banxa/php-sdk)

## Table of Contents

<!-- TOC -->

* [General info](#general-info)
    * [Installation](#installation)
    * [Authentication](#authentication)
        * [Domain, ApiKey and ApiSecret](#apikey-and-apisecret)
    * [Dependencies](#dependencies)
    * [Usage](#usage)
        * [Sandbox](#sandbox)
        * [Production](#production)
* [Localisation](#localisation)
    * [Countries](#countries)
    * [US States](#us-states)
* [Currencies](#currencies)
    * [Fiat](#fiat)
    * [Crypto](#crypto)
* [Payment Methods](#payment-methods)
    * [Buy & Sell order type](#buy--sell-order-type-payment-methods)
    * [Buy order type](#buy-order-type-payment-methods)
    * [Sell order type](#sell-order-type-payment-methods)
* [Prices](#prices)
    * [Buy order types](#buy-order-types-pricing)
    * [Buy order type](#buy-order-type-pricing)
    * [Sell order types](#sell-order-types-pricing)
    * [Sell order type](#sell-order-type-pricing)
* [Orders](#orders)
    * [Retrieving Order(s)](#retrieving-orders)
        * [Fetch orders](#fetch-orders)
        * [Fetch order](#fetch-order)
    * [Order creation](#creating-orders)
        * [Creating a buy order](#creating-a-buy-order)
        * [Creating a NFT buy order](#creating-a-nft-buy-order)
        * [Creating a sell order](#creating-a-sell-order)
    * [Confirm sell order](#confirm-sell-order)
* [Identity](#identity)
    * [Create Identity](#create-identity)

<!-- TOC -->

# General info

The Banxa SDK is a plug and play ready to go implementation to access our services.   
It allows for a simple and fast integration.

# Installation

Install the package via [composer](https://getcomposer.org/)

```php
composer require banxa/php-sdk 
```

# Authentication

## ApiKey and ApiSecret

While on-boarding with banxa, you will be provided with API keys and a subdomain ([partnername].banxa.com),   
initially these will be for the sandbox
environment.
Once you are done testing the implementation, you will receive the credentials to use the production environment.

# Dependencies

| PHP  | Guzzle |
|------|--------|
| ^8.0 | ^7.0   |

# Usage

```php
Banxa::create($subdomain, $apiKey, $apiSecret, $testMode)
```

| Property     | type     | required | description                                                         |
|--------------|----------|----------|---------------------------------------------------------------------|
| `$subdomain` | `string` | `true`   | The subdomain provided by banxa. ([partnername].banxa.com)          |
| `$apiKey`    | `string` | `true`   | Given API key                                                       |
| `$apiSecret` | `string` | `true`   | Given API Secret                                                    |
| `$testMode`  | `bool`   | `false`  | Enable if testing, and provide sandbox api key and secret to method |

###### Sandbox

```php
$subdomain = 'partner';
$sandboxApiKey = 'xxx-xxx-xxx-xxx-xxx';
$sandboxApiSecret = 'xxxx-xxxx-xxxx-xxxx';
$testMode = true;
Banxa::create($subdomain, $sandboxApiKey, $sandboxApiSecret, $testMode)
 ````

###### Production

```php
$subdomain = 'partner';
$apiKey = 'xxx-xxx-xxx-xxx-xxx';
$apiSecret = 'xxxx-xxxx-xxxx-xxxx';
Banxa::create($subdomain, $apiKey, $apiSecret)
````

---

# Localisation

## Countries

> ### Global
> **Fetch all available countries**
>```php
> $banxa->getCountries()
>```

**Result Example**

 ```php
[
    [
        "country_code" => "AD",
        "country_name" => "Andora"
    ],
    [
        "country_code" => "AE",
        "country_name" => "United Arab Emirates"
    ],
]
 ```

### US States

> **Fetch all available US States**
> ```php
> $banxa->getUsStates()
>```

**Result Example**

 ```php
[
    [
        "state_code" => "AL",
        "state_name" => "Alabama"
    ],
    [
        "state_code" => "AK",
        "state_name" => "Alaska"
    ],
]
 ```

---

# Currencies

## Fiat

> ### Buy order type
> **Fetch all available fiat currencies for buy order type.**
>
>```php
> $banxa->getBuyFiatCurrencies()
>```
> ### Sell order type
> **Fetch all available fiat currencies for sell order type.**
>```php
> $banxa->getSellFiatCurrencies()
>```

**Result Example**

 ```php
 [
   [
       "fiat_code"   => "EUR",
       "fiat_name"   => "Euro",
       "fiat_symbol" => "€",
   ],
   [
       "fiat_code"   => "GBP",
       "fiat_name"   => "British Pound Sterling",
       "fiat_symbol" => "£",
   ],
 ]
        
 ```

---

## Crypto

> ### Buy order type
> **Fetch all cryptocurrencies for buy order type.**
>
>```php
> $banxa->getBuyCryptoCurrencies()
>```
> ### Sell order type
> **Fetch all cryptocurrencies for sell-order type.**
>```php
> $banxa->getSellCryptoCurrencies()
>```

**Result Example**

 ```php
[
    [
        "coin_code"=> "BTC",
        "coin_name"=> "Bitcoin",
        "blockchains"=> [
            [
                "code"=> "BTC",
                "description"=> "Bitcoin",
                "is_default"=> true
            ]
        ]
    ],
    [
        "coin_code"=> "ETH",
        "coin_name"=> "Ethereum",
        "blockchains"=> [
            [
                "code"=> "ETH",
                "description"=> "Ethereum (ERC-20)",
                "is_default"=> true
            ],
            [
                "code"=> "MATIC",
                "description"=> "Polygon",
                "is_default"=> false
            ]
        ]
    ]
]
 ```

---

# Payment Methods

### Buy & Sell order type payment methods

> **Fetch all available payment providers for buy and sell order type**
>```php
> $banxa->getAllPaymentMethods()
>```

**Result Example**

 ```php
[
   [
        "id"               => 6036,
        "paymentType"      => "WORLDPAYCREDIT",
        "name"             => "Visa/Mastercard",
        "description"      => "Conveniently buy digital currency using your personal VISA or MasterCard.",
        "logo_url"         => "https://cremorne.1cart.test/images/payment-providers/worldpaycredit.png",
        "status"           => "ACTIVE",
        "supported_agents" => [
            [
                "os"      => "ios",
                "browser" => "safari"
            ],
            [
                "os"      => "macos",
                "browser" => "safari"
            ],
            [
                "os"      => "ipados",
                "browser" => "safari"
            ]
        ],
        "type"             => "FIAT_TO_CRYPTO",
        "supported_fiat"   => [
            "AED",
        ],
        "transaction_fees" => [
            [
                "fiat_code" => "AED",
                "coin_code" => "BTC",
                "fees"      => [
                    [
                        "name"   => "surcharge",
                        "amount" => 3,
                        "type"   => "fixed"
                    ]
                ]
            ],
        ]
    ],
    [
        "id"               => 6036,
        "paymentType"      => "WORLDPAYAPPLE",
        "name"             => "Apple Pay",
        "description"      => "Conveniently buy digital currency using your Apple Pay wallet.",
        "logo_url"         => "https://cremorne.1cart.test/images/payment-providers/apple-pay.png",
        "status"           => "ACTIVE",
        "supported_agents" => [
            [
                "os"      => "ios",
                "browser" => "safari"
            ],
            [
                "os"      => "macos",
                "browser" => "safari"
            ],
            [
                "os"      => "ipados",
                "browser" => "safari"
            ]
        ],
        "type"             => "CRYPTO_TO_FIAT",
        "supported_fiat"   => [
            "AED",
        ],
        "transaction_fees" => [
            [
                "fiat_code" => "AED",
                "coin_code" => "BTC",
                "fees"      => [
                    [
                        "name"   => "surcharge",
                        "amount" => 3,
                        "type"   => "fixed"
                    ]
                ]
            ],
        ]
    ]
];
 ```

### Buy order type payment methods

> **Fetch all available payment providers for buy order type**
>```php
> $banxa->getBuyPaymentMethods($fiatCode, $coinCode)
>```

| Property    | type     | required | description                                                                            |
|-------------|----------|----------|----------------------------------------------------------------------------------------|
| `$fiatCode` | `string` | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats      |
| `$coinCode` | `string` | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto |

**Result Example**

 ```php
[
    "id"               => 6036,
    "paymentType"      => "WORLDPAYAPPLE",
    "name"             => "Apple Pay",
    "description"      => "Conveniently buy digital currency using your Apple Pay wallet.",
    "logo_url"         => "https://cremorne.1cart.test/images/payment-providers/apple-pay.png",
    "status"           => "ACTIVE",
    "supported_agents" => [
        [
            "os"      => "ios",
            "browser" => "safari"
        ],
        [
            "os"      => "macos",
            "browser" => "safari"
        ],
        [
            "os"      => "ipados",
            "browser" => "safari"
        ]
    ],
    "type"             => "CRYPTO_TO_FIAT",
    "supported_fiat"   => [
        "AED",
    ],
    "transaction_fees" => [
        [
            "fiat_code" => "AED",
            "coin_code" => "BTC",
            "fees"      => [
                [
                    "name"   => "surcharge",
                    "amount" => 3,
                    "type"   => "fixed"
                ]
            ]
        ],
    ]
]

 ```

### Sell order type payment methods

> **Fetch all available payment methods for sell order type**
>```php
> $banxa->getSellPaymentMethods($coinCode, $fiatCode)
>```

| Property    | type     | required | description                                                                           |
|-------------|----------|----------|---------------------------------------------------------------------------------------|
| `$coinCode` | `string` | `true`   | Coin code e.g. 'BTC' or 'ETH see [Crypto](#crypto) to get a list all available crypto |
| `$fiatCode` | `string` | `true`   | Fiat code e.g. 'USD' or 'EUR see [Fiat](#fiat) to get a list all available fiats      |

**Result Example**

 ```php
[
    "id"               => 6036,
    "paymentType"      => "WORLDPAYCREDIT",
    "name"             => "Visa/Mastercard",
    "description"      => "Conveniently buy digital currency using your personal VISA or MasterCard.",
    "logo_url"         => "https://cremorne.1cart.test/images/payment-providers/worldpaycredit.png",
    "status"           => "ACTIVE",
    "supported_agents" => [
        [
            "os"      => "ios",
            "browser" => "safari"
        ],
        [
            "os"      => "macos",
            "browser" => "safari"
        ],
        [
            "os"      => "ipados",
            "browser" => "safari"
        ]
    ],
    "type"             => "FIAT_TO_CRYPTO",
    "supported_fiat"   => [
        "AED",
    ],
    "transaction_fees" => [
        [
            "fiat_code" => "AED",
            "coin_code" => "BTC",
            "fees"      => [
                [
                    "name"   => "surcharge",
                    "amount" => 3,
                    "type"   => "fixed"
                ]
            ]
        ],
    ]
]
```

--- 

# Prices

Get prices for [Payment Methods](#payment-methods) to obtain a payment method id for each specific fiat and coin
combination. Should be called when a user requests prices by providing the cryptocurrency, fiat, and fiat amount.

(Rate limited)

### Buy order types pricing

> **Fetch single available price for buy order type for a specific payment method**
>```php
> $banxa->getAllBuyPrices(
>   $fiatCode,
>   $coinCode,
>   $fiatAmount,
>   $blockchain
> )
>```

| Property      | description        | required | description                                                                                                  |
|:--------------|:-------------------|:---------|:-------------------------------------------------------------------------------------------------------------|
| `$fiatCode`   | `string`           | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                            |
| `$coinCode`   | `string`           | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                       |
| `$fiatAmount` | `string/int/float` | `true`   | Fiat amount                                                                                                  |
| `$blockchain` | `string`           | `false`  | Blockchain code e.g. 'ETH' or 'TRON' see [Crypto](#crypto) to get a list all available blockchains per coin. |

**Result Example**

```php 
[
    "spot_price" => "1.07",
    "prices" => [
        [
            "payment_method_id" => 6047,
            "type" => "FIAT_TO_CRYPTO",
            "spot_price_fee" => "0.00",
            "spot_price_including_fee" => "1.07",
            "coin_amount" => "93.84000000",
            "coin_code" => "USDT",
            "fiat_amount" => "100.00",
            "fiat_code" => "USD",
            "fee_amount" => "0.00",
            "network_fee" => "2.37"
        ],
        [
            "payment_method_id" => 6058,
            "type" => "FIAT_TO_CRYPTO",
            "spot_price_fee" => "0.00",
            "spot_price_including_fee" => "1.09",
            "coin_amount" => "93.84000000",
            "coin_code" => "USDT",
            "fiat_amount" => "100.00",
            "fiat_code" => "USD",
            "fee_amount" => "0.00",
            "network_fee" => "2.37"
        ]
    ]
]
```

---

### Buy order type pricing

> **Fetch single price for buy order type for a specific payment method**
> ```php
> $banxa->getBuyPrice(
>    $fiatCode,
>    $coinCode,
>    $fiatAmount,
>    $paymentMethodId,
>    $blockchain
> )
>```

| Property           | type               | required | required                                                                                                                                      |
|:-------------------|:-------------------|:---------|:----------------------------------------------------------------------------------------------------------------------------------------------|
| `$fiatCode`        | `string`           | `true`   | Fiat code e.g. 'USD' or 'EUR see [Fiat](#fiat) to get a list all available fiats                                                              |
| `$coinCode`        | `string`           | `true`   | Coin code e.g. 'BTC' or 'ETH see [Crypto](#crypto) to get a list all available crypto                                                         |
| `$fiatAmount`      | `string/int/float` | `true`   | Fiat amount                                                                                                                                   |
| `$paymentMethodId` | `string/int/float` | `true`   | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`      | `string`           | `false`  | Blockchain code e.g. 'ETH' or 'TRON' see [Crypto](#crypto) to get a list all available blockchains per coin.                                  |

**Result Example**

```php
[
    "payment_method_id" => 6058,
    "type" => "FIAT_TO_CRYPTO",
    "spot_price_fee" => "0.00",
    "spot_price_including_fee" => "1.09",
    "coin_amount" => "93.84000000",
    "coin_code" => "USDT",
    "fiat_amount" => "100.00",
    "fiat_code" => "USD",
    "fee_amount" => "0.00",
    "network_fee" => "2.37"
]
```

## Sell order types pricing

> **Fetch all available prices for sell order type**
> ```php
> $banxa->getAllSellPrices(
>   $coinCode, 
>   $fiatCode, 
>   $coinAmount
> )
> ```

| Property      | type               | required | description                                                                            |
|:--------------|:-------------------|:---------|:---------------------------------------------------------------------------------------|
| `$coinCode`   | `string`           | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto |
| `$fiatCode`   | `string`           | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats      |
| `$coinAmount` | `string/int/float` | `true`   | Crypto amount that will be used to calculate the fiat amount                           |

**Result Example**

```php 
[
    "spot_price" => "1.07",
    "prices" => [
        [
            "payment_method_id" => 6045,
            "type" => "CRYPTO_TO_FIAT",
            "spot_price_fee" => "0.00",
            "spot_price_including_fee" => "32500.00",
            "coin_amount" => "0.02000000",
            "coin_code" => "BTC",
            "fiat_amount" => "100.00",
            "fiat_code" => "AUD",
            "fee_amount" => "0.00",
            "network_fee" => "0.00"
        ],
        [
            "payment_method_id" => 6046,
            "type" => "CRYPTO_TO_FIAT",
            "spot_price_fee" => "0.00",
            "spot_price_including_fee" => "32500.00",
            "coin_amount" => "0.04000000",
            "coin_code" => "BTC",
            "fiat_amount" => "650.00",
            "fiat_code" => "AUD",
            "fee_amount" => "0.00",
            "network_fee" => "0.00"
        ],
    ]
]
```

### Sell order type pricing

> **Fetch single price for buy order type for a specific payment method**
> ```php
> $banxa->getSellPrice(
>   $coinCode, 
>   $fiatCode, 
>   $coinAmount, 
>   $paymentMethodId
> )
>```

| Property           | type               | required | description                                                                                                                                   |
|:-------------------|:-------------------|:---------|:----------------------------------------------------------------------------------------------------------------------------------------------|
| `$coinCode`        | `string`           | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$fiatCode`        | `string`           | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$coinAmount`      | `string/int/float` | `true`   | Crypto amount that will be used to calculate                                                                                                  |
| `$paymentMethodId` | `string/int`       | `true`   | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |

**Result Example**

```php
[
    "payment_method_id" => 6033,
    "type" => "CRYPTO_TO_FIAT",
    "spot_price_fee" => "0.00",
    "spot_price_including_fee" => "1.09",
    "coin_amount" => "93.84000000",
    "coin_code" => "USDT",
    "fiat_amount" => "100.00",
    "fiat_code" => "USD",
    "fee_amount" => "0.00",
    "network_fee" => "2.37"
]
```

---

# Orders

## Retrieving orders

### Fetch orders

> **Fetch all orders within a specific time range. (paginated)**
>```php
> $banxa->getOrders(
>   $startDate, 
>   $endDate, 
>   $statuses, 
>   $perPage, 
>   $page, 
>   $accountReference
> )
>```

| Property                | type           | required | description                                                                                                           |
|:------------------------|:---------------|:---------|:----------------------------------------------------------------------------------------------------------------------|
| `$startDate`            | `string`       | `true`   | Start date used for filtering orders. Must be a date in the format YYYY-MM-DD.                                        |
| `$endDate`              | `string`       | `true`   | End date used for filtering orders. Must be a date in the format YYYY-MM-DD.                                          |
| `$statuses`             | `array`        | `false`  | One or many order statuses (see 'Available Statuses')                                                                 |
| `$perPage`              | `string/int`   | `false`  | Page size.                                                                                                            |
| `$page`                 | `string/int`   | `false`  | Page to retrieve.                                                                                                     |
| `$accountReference`     | `string`       | `false`  | Customer reference that was passed as a parameter when creating an order. Used to retrieve all orders for a customer. |

| Available Statuses              |
|:--------------------------------|
| `OrderStatus::PENDING_PAYMENT`  |
| `OrderStatus::WAITING_PAYMENT`  |
| `OrderStatus::PAYMENT_RECEIVED` |
| `OrderStatus::IN_PROGRESS`      |
| `OrderStatus::COIN_TRANSFERRED` |
| `OrderStatus::CANCELLED`        |
| `OrderStatus::DECLINED`         |
| `OrderStatus::EXPIRED`          |
| `OrderStatus::COMPLETE`         |
| `OrderStatus::REFUNDED`         |

**Result Example**

```php
[
    [
        "id"                  => "e7f3d4e436c8925af84a391f317aaa6e",
        "account_id"          => "ebfef819583ff4573e6db307abd9c126",
        "account_reference"   => "banxa-account",
        "order_type"          => "CRYPTO-BUY",
        "ref"                 => 501903,
        "country"             => "AU",
        "fiat_code"           => "AUD",
        "fiat_amount"         => 100,
        "coin_code"           => "BTC",
        "coin_amount"         => 0.00704583,
        "wallet_address"      => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "wallet_address_tag"  => null,
        "fee"                 => 0,
        "fee_tax"             => 0,
        "payment_fee"         => 2.14,
        "payment_fee_tax"     => 0.19,
        "commission"          => 0,
        "tx_hash"             => "sync-tx:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "tx_confirms"         => 10,
        "created_date"        => "01-Jul-2022",
        "created_at"          => "01-Jul-2022 07:51:18",
        "payment_type"        => "WorldPay Credit Card",
        "status"              => "complete",
        "completed_at"        => "01-Jul-2022 07:55:19",
        "merchant_fee"        => 0,
        "merchant_commission" => 0,
        "meta_data"           => null,
        "blockchain"          => [
        "code"        => "BTC",
        "description" => "Bitcoin"
        ]
   ],
   [
        "id"                  => "b719377e3541921297ebef33016fb068",
        "account_id"          => "ebfef819583ff4573e6db307abd9c126",
        "account_reference"   => "banxa-account",
        "order_type"          => "CRYPTO-BUY",
        "ref"                 => 501902,
        "country"             => "AU",
        "fiat_code"           => "AUD",
        "fiat_amount"         => 320,
        "coin_code"           => "BTC",
        "coin_amount"         => 0.02255405,
        "wallet_address"      => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "wallet_address_tag"  => null,
        "fee"                 => 0,
        "fee_tax"             => 0,
        "payment_fee"         => 6.83,
        "payment_fee_tax"     => 0.62,
        "commission"          => 0,
        "tx_hash"             => "sync-tx:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "tx_confirms"         => 10,
        "created_date"        => "01-Jul-2022",
        "created_at"          => "01-Jul-2022 07:51:18",
        "payment_type"        => "WorldPay Credit Card",
        "status"              => "complete",
        "completed_at"        => "01-Jul-2022 07:55:19",
        "merchant_fee"        => 0,
        "merchant_commission" => 0,
        "meta_data"           => null,
        "blockchain"          => [
            "code"        => "BTC",
            "description" => "Bitcoin"
        ]
   ]
]
```

---

### Fetch order

> **Fetch single order**
>```php
> $banxa->getOrder($orderId);
>```

| Property   | description | required | description                        |
|:-----------|:------------|:---------|:-----------------------------------|
| `$orderId` | `string`    | `true`   | Unique ID of the order to retrieve |

**Result Example**

```php
[
    "id"                  => "b719377e3541921297ebef33016fb068",
    "account_id"          => "ebfef819583ff4573e6db307abd9c126",
    "account_reference"   => "banxa-account",
    "order_type"          => "CRYPTO-BUY",
    "ref"                 => 501902,
    "country"             => "AU",
    "fiat_code"           => "AUD",
    "fiat_amount"         => 320,
    "coin_code"           => "BTC",
    "coin_amount"         => 0.02255405,
    "wallet_address"      => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "wallet_address_tag"  => null,
    "fee"                 => 0,
    "fee_tax"             => 0,
    "payment_fee"         => 6.83,
    "payment_fee_tax"     => 0.62,
    "commission"          => 0,
    "tx_hash"             => "sync-tx:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "tx_confirms"         => 10,
    "created_date"        => "01-Jul-2022",
    "created_at"          => "01-Jul-2022 07:51:18",
    "payment_type"        => "WorldPay Credit Card",
    "status"              => "complete",
    "completed_at"        => "01-Jul-2022 07:55:19",
    "merchant_fee"        => 0,
    "merchant_commission" => 0,
    "meta_data"           => null,
    "blockchain"          => [
        "code"        => "BTC",
        "description" => "Bitcoin"
    ]
]
```

---

## Creating orders

Allows your customer to create a buy or sell crypto order with Banxa. Upon success, the response will contain a checkout
URL which will be unique for the order. The customer will be redirected to this URL to complete the checkout process,
which will expire after 1 minute if a redirect does not occur.

When creating an order you will be required to create a BuyOrderTransaction/SellOrderTransaction/NftBuyOrderTransaction
object.
This object will allow you to create a transaction using a fiat amount, coin amount, or if you require both, you can
specify your own amount using the createDynamic method, this will depend on your business use case.

### Creating a buy order

> ```php
> $banxa->createBuyOrder(
>   $buyOrderTransaction,
>   $returnUrlOnSuccess,
>   $returnUrlOnFailure,
>   $returnUrlOnCancelled,
>   $metadata,
>   $readOnlyAmounts,
>   $iframeRefererDomain,
> );
>```

| Property                | type          | required | description                                                                                                                                                                 |
|-------------------------|---------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$buyOrderTransaction`  | `Object`      | `true`   | `BuyOrderTransaction` object                                                                                                                                                |
| `$returnUrlOnSuccess`   | `string`      | `true`   | The return url on success                                                                                                                                                   | 
| `$returnUrlOnFailure`   | `string/null` | `false`  | The return url on failure                                                                                                                                                   | 
| `$returnUrlOnCancelled` | `string/null` | `false`  | The return url on cancelled                                                                                                                                                 | 
| `$metadata`             | `string/null` | `false`  | Free form string that you can use to send us any information that will be returned in the Get Orders endpoint                                                               | 
| `$readOnlyAmounts`      | `boolean`     | `false`  | Will cause the cryptocurrency and fiat amounts on the Banxa screens to be read-only and un-editable.                                                                        |
| `$iframeRefererDomain`  | `string/null` | `false`  | Used if you are embedding an iFrame. This must be the exact domain where the iFrame will be hosted. e.g. [yourCompany].com. Do not include https:// in front of the domain. |

---

> **BuyOrderTransaction using Fiat as base amount**
>```php
> $buyOrderTransaction = BuyOrderTransaction::createFromFiatAmount(
>       $accountReference, 
>       $fiatCode, 
>       $coinCode, 
>       $fiatAmount, 
>       $walletAddress, 
>       $paymentMethodId
>   );
>```

| Property            | type              | required | description                                                                                                                                   |
|---------------------|-------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`          | `true`   | The customer's unique ID                                                                                                                      |
| `$fiatCode`         | `string`          | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$coinCode`         | `string`          | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$fiatAmount`       | `string/float`    | `true`   | Fiat amount                                                                                                                                   |
| `$walletAddress`    | `string`          | `true`   | The target wallet address to transfer the coin to                                                                                             |
| `$paymentMethodId`  | `int/string/null` | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`     | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`     | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

---

> **BuyOrderTransaction using Coin as base amount**
>```php
>  $buyOrderTransaction = BuyOrderTransaction::createFromCoinAmount(
>       $accountReference, 
>       $fiatCode, 
>       $coinCode, 
>       $coinAmount, 
>       $walletAddress, 
>       $paymentMethodId
>   );
>```
>

| Property            | type               | required | description                                                                                                                                   |
|---------------------|--------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`           | `true`   | The customer's unique ID                                                                                                                      |
| `$fiatCode`         | `string`           | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$coinCode`         | `string`           | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$coinAmount`       | `string/float`     | `true`   | The coin amount                                                                                                                               |
| `$walletAddress`    | `string`           | `true`   | The target wallet address to transfer the coin to                                                                                             |
| `$paymentMethodId`  | `int/string/null`  | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`      | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`      | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

---
> **BuyOrderTransaction using dynamic sourceAmount or targetAmount**
>
> When using BuyOrderTransaction::createDynamic you will need to specify `$source`(Fiat), `$target`(Coin), and
> either `$sourceAmount` or `$targetAmount`
>```php
>   $buyOrderTransaction = BuyOrderTransaction::createDynamic(
>       $accountReference, 
>       $source, 
>       $target, 
>       $sourceAmount, 
>       $targetAmount, 
>       $walletAddress, 
>       $refundAddress, 
>       $paymentMethodId, 
>       $blockchain, 
>       $walletAddressTag
>   );
>```

| Property            | type                 | required | description                                                                                                                                   |
|---------------------|----------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`             | `true`   | The customer's unique ID                                                                                                                      |
| `$source`           | `string`             | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$target`           | `string`             | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$sourceAmount`     | `string/float/null`  | `true`   | Source amount - null if targetAmount is set                                                                                                   |
| `$targetAmount`     | `string/float/null`  | `true`   | Target amount - null if sourceAmount is set                                                                                                   |
| `$walletAddress`    | `string/null`        | `true`   | The target wallet address to transfer the coin to - For Buy orders only                                                                       |
| `$refundAddress`    | `string/null`        | `true`   | The refund wallet address - For sell orders only                                                                                              |
| `$paymentMethodId`  | `int/string/null`    | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`        | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`        | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

> **Buy order full example**
>
>```php
>$buyOrderTransaction = BuyOrderTransaction::createFromFiatAmount($accountReference, $fiatCode, $coinCode, $fiatAmount, $walletAddress, $paymentMethodId, $blockchain, $walletAddressTag);// From Fiat Amount
>```
>```php
>$buyOrderTransaction = BuyOrderTransaction::createFromCoinAmount($accountReference, $fiatCode, $coinCode, $coinAmount, $walletAddress, $paymentMethodId, $blockchain, $walletAddressTag);// From Coin Amount
>```
>```php
>$buyOrderTransaction = BuyOrderTransaction::createDynamic($accountReference, $source, $target, $sourceAmount, null, $walletAddress, null, $paymentMethodId, $blockchain, $walletAddressTag); // Dynamic
>```
>```php
>$buyOrderTransaction = BuyOrderTransaction::createDynamic($accountReference, $source, $target, null, $targetAmount, $walletAddress, null, $paymentMethodId, $blockchain, $walletAddressTag); // Dynamic
>```
>```php
>$banxa->createBuyOrder(
>     $buyOrderTransaction,
>     $returnUrlOnSuccess,
>     $returnUrlOnFailure,
>     $returnUrlOnCancelled,
>     $metadata,
>     $readOnlyAmounts,
>     $iframeRefererDomain,
>     );
>```
>
>
>**Result Example**
>
>```php
>[
>    "id"                => "b890df4aee4583a25ca8da17eb863c81",
>    "account_id"        => "3ec8d3c67617af11d84a18931c4e369d",
>    "account_reference" => "banxa-test-01",
>    "order_type"        => "CRYPTO-BUY",
>    "fiat_code"         => "AUD",
>    "fiat_amount"       => 1,
>    "coin_code"         => "BTC",
>    "wallet_address"    => "1LbQ1WNTsm1Nzj1hbh3WDCbEim1oUg5rfi",
>    "blockchain"        => [
>        "id"          => 1,
>        "code"        => "BTC",
>        "description" => "Bitcoin"
>    ],
>    "created_at"        => "17-Aug-2022 00:09:03",
>    "checkout_url"      => "https://your-return-url"
>]
>```
---

### Creating a NFT buy order

> ```php
> $banxa->createNftBuyOrder(
>   $nftBuyOrderTransaction,
>   $nftData,
>   $returnUrlOnSuccess,
>   $returnUrlOnFailure,
>   $returnUrlOnCancelled,
>   $iframeRefererDomain
> );
>```

| Property                  | type          | required | description                                                                                                                                                                 |
|---------------------------|---------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$nftBuyOrderTransaction` | `Object`      | `true`   | `NftBuyOrderTransaction` object                                                                                                                                             |
| `$nftData`                | `Object`      | `true`   | `NftData` object                                                                                                                                                            |
| `$returnUrlOnSuccess`     | `string`      | `true`   | The return url on success                                                                                                                                                   | 
| `$returnUrlOnFailure`     | `string/null` | `false`  | The return url on failure                                                                                                                                                   | 
| `$returnUrlOnCancelled`   | `string/null` | `false`  | The return url on cancelled                                                                                                                                                 | 
| `$iframeRefererDomain`    | `string/null` | `false`  | Used if you are embedding an iFrame. This must be the exact domain where the iFrame will be hosted. e.g. [yourCompany].com. Do not include https:// in front of the domain. |

---

> **NftBuyOrderTransaction**
>```php
> $nftBuyOrderTransaction = NftBuyOrderTransaction::create(
>        $accountReference,
>        $fiatCode,
>        $coinCode,
>        $fiatAmount,
>        $walletAddress,
>        $paymentMethodId = null,
>        $blockchain = null,
>        $walletAddressTag = null
>   );
>```

| Property            | type              | required | description                                                                                                                                   |
|---------------------|-------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`          | `true`   | The customer's unique ID                                                                                                                      |
| `$fiatCode`         | `string`          | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$coinCode`         | `string`          | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$fiatAmount`       | `string/float`    | `true`   | Fiat amount                                                                                                                                   |
| `$walletAddress`    | `string`          | `true`   | The target wallet address to transfer the coin to                                                                                             |
| `$paymentMethodId`  | `int/string/null` | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`     | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`     | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

---

> **NftData**
>```php
>  $nftData = NftData::create(
>       $purchaseReference, 
>       $nft, 
>       $metaData
>   );
>```

| Property             | type     | required | description                 |
|----------------------|----------|----------|-----------------------------|
| `$purchaseReference` | `string` | `true`   | A reference of the purchase |
| `$nft`               | `Object` | `true`   | `Nft` object                |
| `$metaData`          | `array`  | `false`  | Array of metaData           |

---
> **Nft**
>
>```php
>   $nft = Nft::create(
>       $name, 
>       $collection, 
>       $nftMedia,
>   );
>```

| Property      | type           | required | description              |
|---------------|----------------|----------|--------------------------|
| `$name`       | `string`       | `true`   | The name of the NFT      |
| `$collection` | `string`       | `true`   | The Collection the NFT   |
| `$nftMedia`   | `object`       | `true`   | `NftMedia` object        |

---
> **Create VideoNftMedia**
>
>```php
>   $nftMedia = VideoNftMedia::create($link);
>```
> **Create ImageNftMedia**
>
>```php
>   $nftMedia = ImageNftMedia::create($link);
>```

| Property      | type           | required | description             |
|---------------|----------------|----------|-------------------------|
| `link`        | `string`       | `true`   | A link to the Nft video |

---

> **Nft buy order full example**
>
>```php
>
>$nftBuyOrderTransaction = NftBuyOrderTransaction::create(
>      $accountReference, 
>      $fiatCode, 
>      $coinCode, 
>      $fiatAmount, 
>      $walletAddress, 
>      $paymentMethodId, 
>      $blockchain, 
>      $walletAddressTag
>   );
>
>
>   $nftMedia = ImageNftMedia::create($link); // OR $nftMedia = VideoNftMedia::create($link)
>
>
>   $nft = Nft::create(
>       $name, 
>       $collection, 
>       $nftMedia,
>   );
>
>  $nftData = NftData::create(
>       $purchaseReference, 
>       $nft, 
>       $metaData
>   );
>
>   $banxa->createNftBuyOrder(
>       $nftBuyOrderTransaction,
>       $nftData,
>       $returnUrlOnSuccess,
>       $returnUrlOnFailure,
>       $returnUrlOnCancelled,
>       $iframeRefererDomain,
>     );
>```
>
>
>**Result Example**
>
>```php
>[
>    "id"                => "b890df4aee4583a25ca8da17eb863c81",
>    "account_id"        => "3ec8d3c67617af11d84a18931c4e369d",
>    "account_reference" => "Banxa-Testing-01",
>    "order_type"        => "NFT-BUY",
>    "blockchain"        => [
>        "id"          => 1,
>        "code"        => "ETH",
>        "description" => "Ethereum (ERC-20)"
>    ],
>    "created_at"        => "17-Aug-2022 00:09:03",
>    "checkout_url"      => "https://your-return-url"
>]
>```
---

### Creating a Sell order

> ```php
> $banxa->createSellOrder(
>   $sellOrderTransaction,
>   $returnUrlOnSuccess,
>   $returnUrlOnFailure,
>   $returnUrlOnCancelled,
>   $metadata,
>   $readOnlyAmounts,
>   $iframeRefererDomain,
> )
>```

| Property                  | type          | required | description                                                                                                                                                                 |
|---------------------------|---------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$sellOrderTransaction`   | `Object`      | `true`   | `SellOrdertransaction` object                                                                                                                                               |
| `$returnUrlOnSuccess`     | `string`      | `true`   | The return url on success                                                                                                                                                   | 
| `$returnUrlOnFailure`     | `string/null` | `false`  | The return url on failure                                                                                                                                                   | 
| `$returnUrlOnCancelled`   | `string/null` | `false`  | The return url on cancelled                                                                                                                                                 | 
| `$metadata`               | `string/null` | `false`  | Free form string that you can use to send us any information that will be returned in the Get Orders endpoint                                                               | 
| `$readOnlyAmounts`        | `boolean`     | `false`  | Will cause the cryptocurrency and fiat amounts on the Banxa screens to be read-only and un-editable.                                                                        |
| `$iframeRefererDomain`    | `string/null` | `false`  | Used if you are embedding an iFrame. This must be the exact domain where the iFrame will be hosted. e.g. [yourCompany].com. Do not include https:// in front of the domain. |

---

> **SellOrderTransaction using Fiat as base amount**
>```php
> $sellOrderTransaction = SellOrderTransaction::createFromFiatAmount(
>       $accountReference, 
>       $fiatCode, 
>       $coinCode, 
>       $fiatAmount, 
>       $refundAddress, 
>       $paymentMethodId,
>       $blockchain,
>       $walletAddressTag,
>);
>```

| Property            | type              | required | description                                                                                                                                   |
|---------------------|-------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`          | `true`   | The customer's unique ID                                                                                                                      |
| `$fiatCode`         | `string`          | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$coinCode`         | `string`          | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$fiatAmount`       | `string/float`    | `true`   | Fiat amount                                                                                                                                   |
| `$refundAddress`    | `string`          | `true`   | The refund wallet address if the order gets rejected                                                                                          |
| `$paymentMethodId`  | `int/string/null` | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`     | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`     | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

---


> **sellOrderTransaction using Coin as base amount**
>```php
> $sellOrderTransaction = SellOrderTransaction::createFromCoinAmount(
>       $accountReference, 
>       $fiatCode, 
>       $coinCode, 
>       $coinAmount, 
>       $refundAddress, 
>       $paymentMethodId,
>       $blockchain,
>       $walletAddressTag,
>   );
>```

| Property            | type              | required | description                                                                                                                                   |
|---------------------|-------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`          | `true`   | The customer's unique ID                                                                                                                      |
| `$fiatCode`         | `string`          | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$coinCode`         | `string`          | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$coinAmount`       | `string/float`    | `true`   | The coin amount                                                                                                                               |
| `$refundAddress`    | `string`          | `true`   | The refund wallet address if the order gets rejected                                                                                          |
| `$paymentMethodId`  | `int/string/null` | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`     | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`     | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

---


> **sellOrderTransaction using dynamic sourceAmount or targetAmount**
>
> When using SellOrderTransaction::createDynamic you will need to specify `$source`(Fiat), `$target`(Coin), and
> either `$sourceAmount` or `$targetAmount`
>```php
> $sellOrderTransaction = SellOrderTransaction::createDynamic(
>       $accountReference, 
>       $source, 
>       $target, 
>       $sourceAmount, 
>       $targetAmount, 
>       $walletAddress, 
>       $refundAddress, 
>       $paymentMethodId, 
>       $blockchain, 
>       $walletAddressTag
>   );
>```

| Property            | type                | required | description                                                                                                                                   |
|---------------------|---------------------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| `$accountReference` | `string`            | `true`   | The customer's unique ID                                                                                                                      |
| `$source`           | `string`            | `true`   | Fiat code e.g. 'USD' or 'EUR' see [Fiat](#fiat) to get a list all available fiats                                                             |
| `$target`           | `string`            | `true`   | Coin code e.g. 'BTC' or 'ETH' see [Crypto](#crypto) to get a list all available crypto                                                        |
| `$sourceAmount`     | `string/float/null` | `true`   | Source amount - null if targetAmount is set                                                                                                   |
| `$targetAmount`     | `string/float/null` | `true`   | Target amount - null if sourceAmount is set                                                                                                   |
| `$walletAddress`    | `string/null`       | `true`   | The target wallet address to transfer the coin to - For Buy orders only                                                                       |
| `$refundAddress`    | `string/null`       | `true`   | The refund wallet address - For sell orders only                                                                                              |
| `$paymentMethodId`  | `int/string/null`   | `false`  | Unique ID for the payment method that you want to get prices for. see [Payment Methods](#payment-methods) to get a list of payment providers. |
| `$blockchain`       | `string/null`       | `false`  | Blockchain code, the list of available blockchains per coin @see [Crypto](#crypto) for all available blockchains per coin                     |
| `$walletAddressTag` | `string/null`       | `false`  | Wallet tag or memo associated with the wallet address. Should be sent for buy cryptocurrency orders only for BNB (Memo) or XRP (Tag).         |

> **Sell order full example**
>
>```php
>$sellOrderTransaction = SellOrderTransaction::createFromFiatAmount($accountReference, $fiatCode, $coinCode, $fiatAmount, $refundAddress, $paymentMethodId, $blockchain, $walletAddressTag);// From Fiat Amount
>```
>```php
>$sellOrderTransaction = SellOrderTransaction::createFromCoinAmount($accountReference, $fiatCode, $coinCode, $coinAmount, $refundAddress, $paymentMethodId, $blockchain, $walletAddressTag);// From Coin Amount
>```
>```php
>$sellOrderTransaction = SellOrderTransaction::createDynamic($accountReference, $source, $target, $sourceAmount, null, null, $refundAddress, $paymentMethodId, $blockchain, $walletAddressTag); // Dynamic
>```
>```php
>$sellOrderTransaction = SellOrderTransaction::createDynamic($accountReference, $source, $target, null, $targetAmount, null, $refundAddress, $paymentMethodId, $blockchain, $walletAddressTag); // Dynamic
>```
>```php
>$banxa->createSellOrder(
>    $sellOrderTransaction,
>    $returnUrlOnSuccess,
>    $returnUrlOnFailure,
>    $returnUrlOnCancelled,
>    $metadata,
>    $readOnlyAmounts,
>    $iframeRefererDomain,
>);
>```
>
>**Result Example**
>
>```php
>[
>    "id"                => "b890df4aee4583a25ca8da17eb863c81",
>    "account_id"        => "3ec8d3c67617af11d84a18931c4e369d",
>    "account_reference" => "banxa-test-01",
>    "order_type"        => "CRYPTO-SELL",
>    "fiat_code"         => "AUD",
>    "fiat_amount"       => 1,
>    "coin_code"         => "BTC",
>    "wallet_address"    => "1LbQ1WNTsm1Nzj1hbh3WDCbEim1oUg5rfi",
>    "blockchain"        => [
>        "id"          => 1,
>        "code"        => "BTC",
>        "description" => "Bitcoin"
>    ],
>    "created_at"        => "17-Aug-2022 00:09:03",
>    "checkout_url"      => "https://your-return-url"
>
>]
>```
---

### Confirm sell order

> **Once the coin amount transfer for a Sell Order has been executed,    
Banxa must be notified by sending a request to this endpoint with transaction hash, source and destination wallet
address details.**
>```php
> $banxa->confirmSellOrder(
>       $orderId,
>       $txHash,
>       $sourceAddress,
>       $destinationAddress,
>       $sourceAddressTag,
>       $destinationAddressTag
> )
>```

| Property                 | type          | required | description                                                                                         |
|--------------------------|---------------|:---------|:----------------------------------------------------------------------------------------------------|
| `$orderId`               | `string`      | `true`   | Unique ID for the the order                                                                         |
| `$txHash`                | `string`      | `true`   | Blockchain transaction hash of the order                                                            |
| `$sourceAddress`         | `string`      | `true`   | The provided customer's source wallet address                                                       |
| `$destinationAddress`    | `string`      | `true`   | The wallet address provided to merchants to transact to                                             |
| `$sourceAddressTag`      | `string/null` | `false`  | The customer's source wallet address tag if the provided source wallet address requires it          |
| `$destinationAddressTag` | `string/null` | `false`  | The wallet address tag provided to merchants if the provided destination wallet address requires it |

**Result Example**

```php
[
    "id"                  => "ee94a43403fb608f341dd5c4c899b846",
    "account_id"          => "d6e7ab2b8f638bed61dc0ac5bec37d4d",
    "account_reference"   => "banxa-account",
    "order_type"          => "CRYPTO-SELL",
    "payment_type"        => "CLEARJCNSELLFP",
    "ref"                 => 507000,
    "fiat_code"           => "AUD",
    "fiat_amount"         => 100,
    "coin_code"           => "BTC",
    "coin_amount"         => 0.00286436,
    "wallet_address"      => null,
    "wallet_address_tag"  => null,
    "fee"                 => 9.1,
    "fee_tax"             => 0,
    "payment_fee"         => 0,
    "payment_fee_tax"     => 0,
    "commission"          => 0.1,
    "tx_hash"             => null,
    "tx_confirms"         => 0,
    "created_date"        => "01-Jul-2022",
    "created_at"          => "01-Jul-2022 07:51:18",
    "status"              => "in progress",
    "completed_at"        => null,
    "merchant_fee"        => 6.54,
    "merchant_commission" => 0.05,
    "meta_data"           => null,
    "blockchain"          => [
        "id"          => 1,
        "code"        => "BTC",
        "description" => "Bitcoin"
    ]
]
```

---

# Identity

## Create Identity

> **Allows you to share customer details with Banxa before an Order is created.   
> This reduces the need for customers to re-submit personal details and upload KYC documentation during the Banxa
checkout
> flow.    
> Detailed guide on how to implement this API can be found [here](https://docs.banxa.com/docs/identities-service).
> You can also find Testing information [here](https://docs.banxa.com/docs/order-flow)**
>```php
> $banxa->createIdentity(
>   $identitySharingCollection,
>   $customerDetails,
>   $customerIdentity,
>   $identityDocumentCollection,
>   $residentialAddress
> )
>```

| Property                      | type          | required | description                         |
|-------------------------------|---------------|----------|-------------------------------------|
| `$identitySharingCollection`  | `Object`      | `true`   | `IdentitySharingCollection` object  |
| `$customerDetails`            | `Object`      | `true`   | `CustomerDetail` object             | 
| `$customerIdentity`           | `Object`      | `true`   | `CustomerIdentity` object           |
| `$identityDocumentCollection` | `Object/null` | `false`  | `IdentityDocumentCollection` object |
| `$residentialAddress`         | `Object/null` | `false`  | `ResidentialAddress` object         |

##### IdentitySharingCollection

```php 
 IdentitySharingCollection::create($kycProviders)
 ```

| Property        | type    | required | description                         |
|-----------------|---------|----------|-------------------------------------|
| `$kycProviders` | `array` | `true`   | array of `IdentityProvider` objects |

##### IdentitySharingProvider

```php 
 IdentitySharingProvider::create($provider, $token)
 ```

| Property    | type     | description                        |
|-------------|----------|------------------------------------|
| `$provider` | `string` | Name of the provider e.g. 'sumsub' |
| `$token`    | `string` | The unique provider token          |

##### IdentityDocument

```php 
 IdentityDocument::create($documentType, $imageLinks, $documentNumber)
 ```

| Property          | type     | required                                                                 | description                                        |
|:------------------|:---------|:-------------------------------------------------------------------------|:---------------------------------------------------|
| `$documentType`   | `string` | `true`                                                                   | The document type (see 'Available document types') |
| `$imageLinks`     | `array`  | `true`                                                                   | Array of image links for the documents type        |
| `$documentNumber` | `string` | `true` **when document type is PASSPORT/IDENTIFICATION/DRIVING_LICENSE** | The document number, located on the document       |

| Available document types                           |
|----------------------------------------------------|
| `IdentityDocument::DOCUMENT_TYPE_DRIVING_LICENCE`  |
| `IdentityDocument::DOCUMENT_TYPE_PASSPORT`         |
| `IdentityDocument::DOCUMENT_TYPE_IDENTIFICATION`   |
| `IdentityDocument::DOCUMENT_TYPE_SELFIE`           |
| `IdentityDocument::DOCUMENT_TYPE_PROOF_OF_ADDRESS` |

#### Full Example

```php
$kycProviders = [
    IdentitySharingProvider::create($provider, $token),
    IdentitySharingProvider::create($provider, $token),
];

$documents = [
    IdentityDocument::create($documentType, $imageLinks, $documentNumber),
    IdentityDocument::create($documentType, $imageLinks),
];

$identitySharingCollection = IdentitySharingCollection::create($kycProviders);
$customerDetails = CustomerDetail::create($accountReference, $mobileNumber, $emailAddress);
$customerIdentity = CustomerIdentity::create($givenName, $surname, $dateOfBirth);
$identityDocumentCollection = IdentityDocumentCollection::create($documents);
$residentialAddress = ResidentialAddress::create($country, $addressLine, $suburb, $postCode, $state);

$banxa->createIdentity(
    $identitySharingCollection,
    $customerDetails,
    $customerIdentity,
    $identityDocumentCollection,
    $residentialAddress
);
```

**Result Example**

```php
[
    "account_id"        => "28d517af407a0566204acd75e3a8e5b7",
    "account_reference" => "test001001"
]
```
