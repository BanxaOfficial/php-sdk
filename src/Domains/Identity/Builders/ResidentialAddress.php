<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

use Banxa\Exceptions\Identity\ResidentialAddressValidationException;
use Banxa\Library\KeyConstants;

class ResidentialAddress
{
    /**
     * @throws ResidentialAddressValidationException
     */
    public function __construct(
        private string $country,
        private string|null $addressLine,
        private string|null $suburb,
        private string|null $postCode,
        private string|null $state
    ) {
        $this->validateInput();
    }

    /**
     * @throws ResidentialAddressValidationException
     */
    private function validateInput(): void
    {
        if (strlen($this->country) > 2) {
            throw new ResidentialAddressValidationException('Country must be a ISO 3166 two letter country code', 422);
        }
    }

    /**
     * @throws ResidentialAddressValidationException
     */
    public static function create(
        string $country,
        string|null $addressLine = null,
        string|null $suburb = null,
        string|null $postCode = null,
        string|null $state = null
    ): static {
        return new static($country, $addressLine, $suburb, $postCode, $state);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            KeyConstants::_ADDRESS_LINE_1 => $this->getAddressLine(),
            KeyConstants::_SUBURB         => $this->getSuburb(),
            KeyConstants::_POSTAL_CODE    => $this->getPostCode(),
            KeyConstants::_STATE          => $this->getState(),
            KeyConstants::_COUNTRY        => $this->getCountry(),
        ];
    }

    /**
     * @return string|null
     */
    public function getAddressLine(): null|string
    {
        return $this->addressLine;
    }

    /**
     * @return string|null
     */
    public function getSuburb(): null|string
    {
        return $this->suburb;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): null|string
    {
        return $this->postCode;
    }

    /**
     * @return string|null
     */
    public function getState(): null|string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return strtoupper($this->country);
    }
}