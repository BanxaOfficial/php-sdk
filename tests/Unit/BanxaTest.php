<?php

namespace Tests\Unit;

use Banxa\Banxa;
use Banxa\Client\HttpClient;
use Banxa\Domains\Identity\Builders\CustomerDetail;
use Banxa\Domains\Identity\Builders\CustomerIdentity;
use Banxa\Domains\Identity\Builders\IdentityDocument;
use Banxa\Domains\Identity\Builders\IdentityDocumentCollection;
use Banxa\Domains\Identity\Builders\IdentitySharingCollection;
use Banxa\Domains\Identity\Builders\IdentitySharingProvider;
use Banxa\Domains\Identity\Builders\ResidentialAddress;
use Banxa\Domains\Orders\Builders\BuyOrderTransaction;
use Banxa\Domains\Orders\Builders\Nft;
use Banxa\Domains\Orders\Builders\NftBuyOrderTransaction;
use Banxa\Domains\Orders\Builders\NftData;
use Banxa\Domains\Orders\Builders\SellOrderTransaction;
use Banxa\Domains\Orders\Builders\VideoNftMedia;
use Banxa\Exceptions\Identity\DocumentTypeValidationException;
use Banxa\Exceptions\Identity\InvalidIdentityDocumentException;
use Banxa\Exceptions\Identity\InvalidIdentityProviderException;
use Banxa\Exceptions\Identity\InvalidOrMissingImageLinkProtocolException;
use Banxa\Exceptions\Identity\ResidentialAddressValidationException;
use Banxa\Library\OrderStatus;
use GuzzleHttp\Psr7\Response;
use JsonException;
use Mockery;
use Tests\BaseTestCase;
use Tests\fixtures\Countries\CountriesResponse;
use Tests\fixtures\Countries\UsStatesResponse;
use Tests\fixtures\Currencies\CryptoCurrencyResponse;
use Tests\fixtures\Currencies\FiatResponse;
use Tests\fixtures\Order\OrderResponse;
use Tests\fixtures\PaymentMethods\PaymentMethodResponse;
use Tests\fixtures\Prices\PricesResponse;

/**
 * @runTestsInSeparateProcesses
 * @covers \Banxa\Banxa::getBuyFiatCurrencies::getSellFiatCurrencies::getCountries::getBuyCryptoCurrencies
 * @covers \Banxa\Banxa::getSellCryptoCurrencies::getUsStates::getAllPaymentMethods::getBuyPaymentMethods
 * @covers \Banxa\Banxa::getSellPaymentMethods::getOrder::getOrders::getAllBuyPrices::getAllSellPrices
 * @covers \Banxa\Banxa::getSellPrice::createBuyOrder::createNftBuyOrder::createIdentity::confirmSellOrder
 */
class BanxaTest extends BaseTestCase
{
    /**
     * @throws JsonException
     */
    public function test_getBuyFiatCurrencies(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], FiatResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getBuyFiatCurrencies());
    }

    /**
     * @throws JsonException
     */
    public function test_getSellFiatCurrencies()
    {
        $response = new Response(200, ['Content-type' => 'application/json'], FiatResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getSellFiatCurrencies());
    }

    /**
     * @throws JsonException
     * @runInSeparateProcess
     */
    public function test_getCountries(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], CountriesResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getCountries());
    }

    /**
     * @throws JsonException
     */
    public function test_getBuyCryptoCurrencies(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], CryptoCurrencyResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive(
                'request'
            )->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getBuyCryptoCurrencies());
    }

    /**
     * @throws JsonException
     */
    public function test_getSellCryptoCurrencies(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], CryptoCurrencyResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getSellCryptoCurrencies());
    }

    /**
     * @throws JsonException
     */
    public function test_getUsStates(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], UsStatesResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getUsStates());
    }

    /**
     * @throws JsonException
     */
    public function test_getAllPaymentMethods(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PaymentMethodResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getAllPaymentMethods());
    }

    /**
     * @throws JsonException
     */
    public function test_getBuyPaymentMethods(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PaymentMethodResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getBuyPaymentMethods('AUD', 'BTC'));
    }


    /**
     * @throws JsonException
     */
    public function test_getSellPaymentMethods(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PaymentMethodResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getSellPaymentMethods('AUD', 'BTC'));
    }

    /**
     * @throws JsonException
     */
    public function test_getOrder()
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getOrder('84cecea94e3b8c08386623e46503aebc'));
    }

    /**
     * @throws JsonException
     */
    public function test_getAllBuyPrices(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PricesResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getAllBuyPrices('AUD', 'BTC', 100.25, 'BTC'));
    }

    /**
     * @throws JsonException
     */
    public function test_getBuyPrice(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PricesResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getBuyPrice('AUD', 'BTC', 100.25, 101, 'BTC'));
    }

    /**
     * @throws JsonException
     */
    public function test_getAllSellPrices(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PricesResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getAllSellPrices('AUD', 'BTC', 100.25));
    }

    /**
     * @throws JsonException
     */
    public function test_getSellPrice()
    {
        $response = new Response(200, ['Content-type' => 'application/json'], PricesResponse::get());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getSellPrice('AUD', 'BTC', 1, 2102));
    }

    /**
     * @throws JsonException
     */
    public function test_getOrders(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrders());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);

        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->getOrders(
                '2012-01-01',
                '2012-02-01',
                [OrderStatus::EXPIRED],
                100,
                1,
                'reference-121'
            )
        );
    }

    /**
     * @throws JsonException
     */
    public function test_createBuyOrder(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $orderTransaction = BuyOrderTransaction::createFromFiatAmount(
            'test001asdhjsaklda025412',
            "AUD",
            "BTC",
            100,
            "1LbQ1WNTsm1Nzj1hbh3WDCbEim1oUg5rfi",
            6007,
            null,
            null
        );
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->createBuyOrder(
                $orderTransaction,
                'https://hello.world',
                'https://hello.world',
                'https://hello.world',
                'metadatastring',
                true,
                'https://test'
            )
        );
    }

    /**
     * @throws JsonException
     */
    public function test_createDynamicBuyOrder(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $orderTransaction = BuyOrderTransaction::createDynamic(
            'test001asdhjsaklda025412',
            "AUD",
            "BTC",
            100,
            null,
            "1LbQ1WNTsm1Nzj1hbh3WDCbEim1oUg5rfi",
            null,
            null,
            null,
            null
        );
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->createBuyOrder(
                $orderTransaction,
                'https://hello.world',
                'https://hello.world',
                'https://hello.world',
                'metadatastring',
                true,
                'https://test'
            )
        );
    }

    /**
     * @throws JsonException
     */
    public function test_createSellOrder(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $orderTransaction = SellOrderTransaction::createFromFiatAmount(
            'Banxa-test-01',
            "AUD",
            "BTC",
            100,
            "1LbQ1WNTsm1Nzj1hbh3WDCbEim1oUg5rfi",
            6007,
            null,
            null
        );
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->createSellOrder(
                $orderTransaction,
                'https://hello.world',
                'https://hello.world',
                'https://hello.world',
                'metadatastring',
                true,
                'https://test'
            )
        );
    }


    /**
     * @throws JsonException
     */
    public function test_createDynamicSellOrder(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $orderTransaction = SellOrderTransaction::createDynamic(
            'Banxa-test-01',
            "BTC",
            "AUD",
            .001,
            null,
            null,
            "xxxxxxxxxxxxxxxxxxx",
            null,
            null,
            null
        );
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->createSellOrder(
                $orderTransaction,
                'https://hello.world',
                'https://hello.world',
                'https://hello.world',
                'metadatastring',
                true,
                'https://test'
            )
        );
    }

    /**
     * @throws JsonException
     */
    public function test_createNftBuyOrder(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $orderTransaction = NftBuyOrderTransaction::create(
            "test-13467",
            "AUD",
            "ETH",
            110,
            "0xd2c54D4E5bBDcB17B445063746b9826126e95d62"
        );
        $nftData = NftData::create(
            "Special Reference",
            Nft::create(
                "Test_name",
                "Collection",
                VideoNftMedia::create("testinglink.com.au")
            ),
            ['reference' => 'ref-134233']
        );
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->createNftBuyOrder(
                $orderTransaction,
                $nftData,
                'https://hello.world',
                'https://hello.world',
                'https://hello.world',
                'https://hello.world',

            )
        );
    }

    /**
     * @throws JsonException
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     * @throws InvalidOrMissingImageLinkProtocolException
     * @throws ResidentialAddressValidationException
     */
    public function test_createIdentity(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->createIdentity(
                IdentitySharingCollection::create([
                    IdentitySharingProvider::create('sumsub', 'bar')
                ]),
                CustomerDetail::create('test00100122', '61431000022', 'test@bitcoin.com'),
                CustomerIdentity::create('FooBarBaz', 'FizBuz', '2001-01-01'),
                IdentityDocumentCollection::create([
                    IdentityDocument::create(
                        IdentityDocument::DOCUMENT_TYPE_PASSPORT,
                        ['https://www.orimi.com/pdf-test.pdf'],
                        'BTCBaz007'
                    )
                ]),
                ResidentialAddress::create('FO', '21 FooBarBaz FizBuz', 'Foobaz', '3000 VIC', 'BAZ')
            )
        );
    }

    /**
     * @throws JsonException
     * @throws InvalidIdentityProviderException
     */
    public function test_createIdentity_with_required_parameters(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $this->assertIsArray(
            Banxa::create('API', 'SECRET', true)->createIdentity(
                IdentitySharingCollection::create([
                    IdentitySharingProvider::create('sumsub', 'bar')
                ]),
                CustomerDetail::create('test00100122', '61431000022', 'test@bitcoin.com'),
                CustomerIdentity::create('FooBarBaz', 'FizBuz', '2001-01-01')
            )
        );
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function test_confirmSellOrder(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->confirmSellOrder(
                '84cecea94e3b8c08386623e46503aebc',
                'xxxxxx',
                'xxxxxx',
                'xxxxxxxx',
                'xxxxxxx',
                'xxxxxx',

            )
        );
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function test_confirmSellOrder_with_only_required_parameters(): void
    {
        $response = new Response(200, ['Content-type' => 'application/json'], OrderResponse::getOrder());
        Mockery::mock('overload:' . HttpClient::class)
            ->shouldReceive('request')
            ->andReturn($response);
        $this->assertIsArray(
            Banxa::create('SUBDOMAIN', 'API', 'SECRET', true)->confirmSellOrder(
                '84cecea94e3b8c08386623e46503aebc',
                'xxxxxx',
                'xxxxxx',
                'xxxxxxxx',
            )
        );
    }

}
