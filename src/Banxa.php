<?php

declare(strict_types=1);

namespace Banxa;

use Banxa\Client\HttpClient;
use Banxa\Domains\Countries\GetCountries;
use Banxa\Domains\Countries\GetUsStates;
use Banxa\Domains\Currencies\GetCryptoCurrencies;
use Banxa\Domains\Currencies\GetFiats;
use Banxa\Domains\Identity\Builders\CustomerDetail;
use Banxa\Domains\Identity\Builders\CustomerIdentity;
use Banxa\Domains\Identity\Builders\IdentityDocumentCollection;
use Banxa\Domains\Identity\Builders\IdentitySharingCollection;
use Banxa\Domains\Identity\Builders\ResidentialAddress;
use Banxa\Domains\Identity\CreateIdentity;
use Banxa\Domains\Orders\Builders\BuyOrderTransaction;
use Banxa\Domains\Orders\Builders\NftBuyOrderTransaction;
use Banxa\Domains\Orders\Builders\NftData;
use Banxa\Domains\Orders\Builders\OptionalOrderParameters;
use Banxa\Domains\Orders\Builders\SellOrderTransaction;
use Banxa\Domains\Orders\ConfirmSellOrder;
use Banxa\Domains\Orders\CreateNftOrder;
use Banxa\Domains\Orders\CreateOrder;
use Banxa\Domains\Orders\GetOrder;
use Banxa\Domains\Orders\GetOrders;
use Banxa\Domains\PaymentMethods\GetPaymentMethods;
use Banxa\Domains\Prices\GetPrices;
use JsonException;

class Banxa
{
    /**
     * @var HttpClient
     */
    private HttpClient $httpClient;


    /**
     * @param string $subdomain
     * @param string $apiKey
     * @param string $apiSecret
     * @param bool $testMode
     */
    public function __construct(string $subdomain, string $apiKey, string $apiSecret, bool $testMode)
    {
        $this->httpClient = new HttpClient($subdomain, $apiKey, $apiSecret, $testMode);
    }

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param string $subdomain
     * @param bool $testMode
     * @return Banxa
     */
    public static function create(string $subdomain, string $apiKey, string $apiSecret, bool $testMode = false): Banxa
    {
        return new static($subdomain, $apiKey, $apiSecret, $testMode);
    }

    /**
     * @throws JsonException
     */
    public function getBuyFiatCurrencies(): array|string
    {
        return (new GetFiats($this->httpClient))
            ->setBuyMode()
            ->get();
    }

    /**
     * @throws JsonException
     */
    public function getSellFiatCurrencies(): array
    {
        return (new GetFiats($this->httpClient))
            ->setSellMode()
            ->get();
    }

    /**
     * @throws JsonException
     */
    public function getCountries(): array
    {
        return (new GetCountries($this->httpClient))
            ->get();
    }

    /**
     * @throws JsonException
     */
    public function getBuyCryptoCurrencies(): array
    {
        return (new GetCryptoCurrencies($this->httpClient))
            ->setBuyMode()
            ->get();
    }

    /**
     * @throws JsonException
     */
    public function getSellCryptoCurrencies(): array
    {
        return (new GetCryptoCurrencies($this->httpClient))
            ->setSellMode()
            ->get();
    }

    /**
     * @throws JsonException
     */
    public function getUsStates(): array
    {
        return (new GetUsStates($this->httpClient))->get();
    }

    /**
     * @throws JsonException
     */
    public function getAllPaymentMethods(): array
    {
        return (new GetPaymentMethods($this->httpClient))
            ->setTarget(null)
            ->setSource(null)
            ->get();
    }

    /**
     * @param string $fiatCode
     * @param string $coinCode
     * @return array
     * @throws JsonException
     */
    public function getBuyPaymentMethods(string $fiatCode, string $coinCode): array
    {
        return (new GetPaymentMethods($this->httpClient))
            ->setSource($fiatCode)
            ->setTarget($coinCode)
            ->get();
    }

    /**
     * @param string $coinCode
     * @param string $fiatCode
     * @return array
     * @throws JsonException
     */
    public function getSellPaymentMethods(string $coinCode, string $fiatCode): array
    {
        return (new GetPaymentMethods($this->httpClient))
            ->setSource($coinCode)
            ->setTarget($fiatCode)
            ->get();
    }

    /**
     * @param string $orderId
     * @return array
     * @throws JsonException
     */
    public function getOrder(string $orderId): array
    {
        return (new GetOrder($this->httpClient))->setOrderId($orderId)->get();
    }

    /**
     * @param string $fiatCode
     * @param string $coinCode
     * @param string|float|int $fiatAmount
     * @param string|null $blockchain
     * @return array
     * @throws JsonException
     */
    public function getAllBuyPrices(
        string $fiatCode,
        string $coinCode,
        string|float|int $fiatAmount,
        string|null $blockchain = null
    ): array {
        return (new GetPrices($this->httpClient))
            ->setSource($fiatCode)
            ->setTarget($coinCode)
            ->setSourceAmount($fiatAmount)
            ->setBlockchain($blockchain)
            ->setPaymentMethodId(null)
            ->get();
    }

    /**
     * @param string $fiatCode
     * @param string $coinCode
     * @param string|int|float $fiatAmount
     * @param string|int $paymentMethodId
     * @param string|null $blockchain
     * @return array
     * @throws JsonException
     */
    public function getBuyPrice(
        string $fiatCode,
        string $coinCode,
        string|int|float $fiatAmount,
        string|int $paymentMethodId,
        string|null $blockchain = null
    ): array {
        return (new GetPrices($this->httpClient))
            ->setSource($fiatCode)
            ->setTarget($coinCode)
            ->setSourceAmount($fiatAmount)
            ->setPaymentMethodId($paymentMethodId)
            ->setBlockchain($blockchain)
            ->get();
    }

    /**
     * @param string $coinCode
     * @param string $fiatCode
     * @param string|float $coinAmount
     * @return array
     * @throws JsonException
     */
    public function getAllSellPrices(string $coinCode, string $fiatCode, string|float $coinAmount): array
    {
        return (new GetPrices($this->httpClient))
            ->setSource($coinCode)
            ->setTarget($fiatCode)
            ->setSourceAmount($coinAmount)
            ->setPaymentMethodId(null)
            ->setBlockchain(null)
            ->get();
    }

    /**
     * @param string $coinCode
     * @param string $fiatCode
     * @param string|int|float $coinAmount ,
     * @param string|int|null $paymentMethodId
     * @return array
     * @throws JsonException
     */
    public function getSellPrice(
        string $coinCode,
        string $fiatCode,
        string|int|float $coinAmount,
        string|int|null $paymentMethodId = null
    ): array {
        return (new GetPrices($this->httpClient))
            ->setSource($coinCode)
            ->setTarget($fiatCode)
            ->setSourceAmount($coinAmount)
            ->setPaymentMethodId($paymentMethodId)
            ->setBlockchain(null)
            ->get();
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array $statuses
     * @param string|int $perPage
     * @param string|int $page
     * @param string|null $accountReference
     * @return array
     * @throws JsonException
     */
    public function getOrders(
        string $startDate,
        string $endDate,
        array $statuses = [],
        string|int $perPage = 0,
        string|int $page = 0,
        string|null $accountReference = null
    ): array {
        return (new GetOrders($this->httpClient))
            ->setStartDate($startDate)
            ->setEndDate($endDate)
            ->setStatuses($statuses)
            ->setPerPage($perPage)
            ->setPage($page)
            ->setAccountReference($accountReference)
            ->get();
    }

    /**
     * @param BuyOrderTransaction $buyOrderTransaction
     * @param string $returnUrlOnSuccess
     * @param string|null $returnUrlOnFailure
     * @param string|null $returnUrlOnCancelled
     * @param string|null $metaData
     * @param bool $readOnlyAmounts
     * @param string|null $iframeRefererDomain
     * @param OptionalOrderParameters|null $optionalOrderParameters
     * @return array
     * @throws JsonException
     */
    public function createBuyOrder(
        BuyOrderTransaction $buyOrderTransaction,
        string $returnUrlOnSuccess,
        string|null $returnUrlOnFailure = null,
        string|null $returnUrlOnCancelled = null,
        string|null $metaData = null,
        bool $readOnlyAmounts = false,
        string|null $iframeRefererDomain = null,
        OptionalOrderParameters|null $optionalOrderParameters = null
    ): array {
        return (new CreateOrder($this->httpClient))
            ->setOptionOrderParameters($optionalOrderParameters)
            ->create(
                $buyOrderTransaction,
                $returnUrlOnSuccess,
                $returnUrlOnFailure,
                $returnUrlOnCancelled,
                $metaData,
                $readOnlyAmounts,
                $iframeRefererDomain
            );
    }

    /**
     * @param NftBuyOrderTransaction $nftBuyOrderTransaction
     * @param NftData $nftData
     * @param string $returnUrlOnSuccess
     * @param string|null $returnUrlOnFailure
     * @param string|null $returnUrlOnCancelled
     * @param string|null $iframeRefererDomain
     * @return array
     * @throws JsonException
     */
    public function createNftBuyOrder(
        NftBuyOrderTransaction $nftBuyOrderTransaction,
        NftData $nftData,
        string $returnUrlOnSuccess,
        string|null $returnUrlOnFailure = null,
        string|null $returnUrlOnCancelled = null,
        null|string $iframeRefererDomain = null,
    ): array {
        return (new CreateNftOrder($this->httpClient))->create(
            $nftBuyOrderTransaction,
            $nftData,
            $returnUrlOnSuccess,
            $returnUrlOnFailure,
            $returnUrlOnCancelled,
            $iframeRefererDomain
        );
    }

    /**
     * @param IdentitySharingCollection $identitySharingCollection
     * @param CustomerDetail $customerDetails
     * @param CustomerIdentity $customerIdentity
     * @param IdentityDocumentCollection|null $identityDocumentCollection
     * @return array
     * @throws JsonException
     */
    public function createIdentity(
        IdentitySharingCollection $identitySharingCollection,
        CustomerDetail $customerDetails,
        ResidentialAddress $residentialAddress,
        CustomerIdentity $customerIdentity,
        IdentityDocumentCollection|null $identityDocumentCollection = null,
    ): array {
        return (new CreateIdentity($this->httpClient))->create(
            $identitySharingCollection,
            $customerDetails,
            $residentialAddress,
            $customerIdentity,
            $identityDocumentCollection,
        );
    }

    /**
     * @param SellOrderTransaction $sellOrderTransaction
     * @param string $returnUrlOnSuccess
     * @param string|null $returnUrlOnFailure
     * @param string|null $returnUrlOnCancelled
     * @param string|null $metaData
     * @param bool $readOnlyAmounts
     * @param string|null $iframeRefererDomain
     * @param OptionalOrderParameters|null $optionalOrderParameters
     * @return array
     * @throws JsonException
     */
    public function createSellOrder(
        SellOrderTransaction $sellOrderTransaction,
        string $returnUrlOnSuccess,
        string|null $returnUrlOnFailure = null,
        string|null $returnUrlOnCancelled = null,
        string|null $metaData = null,
        bool $readOnlyAmounts = false,
        string|null $iframeRefererDomain = null,
        OptionalOrderParameters|null $optionalOrderParameters = null
    ): array {
        return (new CreateOrder($this->httpClient))
            ->setOptionOrderParameters($optionalOrderParameters)
            ->create(
                $sellOrderTransaction,
                $returnUrlOnSuccess,
                $returnUrlOnFailure,
                $returnUrlOnCancelled,
                $metaData,
                $readOnlyAmounts,
                $iframeRefererDomain
            );
    }

    /**
     * @param string $orderId
     * @param string $txHash
     * @param string $sourceAddress
     * @param string $destinationAddress
     * @param string|null $sourceAddressTag
     * @param string|null $destinationAddressTag
     * @return array
     * @throws JsonException
     */
    public function confirmSellOrder(
        string $orderId,
        string $txHash,
        string $sourceAddress,
        string $destinationAddress,
        string|null $sourceAddressTag = null,
        string|null $destinationAddressTag = null
    ): array {
        return (new ConfirmSellOrder($this->httpClient))
            ->setOrderId($orderId)
            ->create(
                $txHash,
                $sourceAddress,
                $destinationAddress,
                $sourceAddressTag,
                $destinationAddressTag
            );
    }

}
