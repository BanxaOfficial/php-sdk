<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

class OptionalOrderParameters
{

    /**
     * @param string|null $sourceAddress
     * @param string|null $sourceAddressTag
     * @param string|null $email
     * @param string|null $mobile
     */
    public function __construct(
        protected string|null $sourceAddress = null,
        protected string|null $sourceAddressTag = null,
        protected string|null $email = null,
        protected string|null $mobile = null,
    ) {
    }


    /**
     * @param string|null $sourceAddress
     * @param string|null $sourceAddressTag
     * @param string|null $email
     * @param string|null $mobile
     * @return static
     */
    public static function create(
        string|null $sourceAddress = null,
        string|null $sourceAddressTag = null,
        string|null $email = null,
        string|null $mobile = null,
    ): static {
        return new static(
            $sourceAddress,
            $sourceAddressTag,
            $email,
            $mobile,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            KeyConstants::_SOURCE_ADDRESS     => $this->getSourceAddress(),
            KeyConstants::_SOURCE_ADDRESS_TAG => $this->getSourceAddressTag(),
            KeyConstants::_EMAIL              => $this->getEmail(),
            KeyConstants::_MOBILE             => $this->getMobile(),
        ]);
    }

    /**
     * @return string|null
     */
    public function getSourceAddress(): ?string
    {
        return $this->sourceAddress;
    }

    /**
     * @return string|null
     */
    public function getSourceAddressTag(): ?string
    {
        return $this->sourceAddressTag;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    /**
     * @param string|null $sourceAddress
     * @return OptionalOrderParameters
     */
    public function setSourceAddress(?string $sourceAddress): OptionalOrderParameters
    {
        $this->sourceAddress = $sourceAddress;
        return $this;
    }

    /**
     * @param string|null $sourceAddressTag
     * @return OptionalOrderParameters
     */
    public function setSourceAddressTag(?string $sourceAddressTag): OptionalOrderParameters
    {
        $this->sourceAddressTag = $sourceAddressTag;
        return $this;
    }

    /**
     * @param string|null $email
     * @return OptionalOrderParameters
     */
    public function setEmail(?string $email): OptionalOrderParameters
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null $mobile
     * @return OptionalOrderParameters
     */
    public function setMobile(?string $mobile): OptionalOrderParameters
    {
        $this->mobile = $mobile;
        return $this;
    }


}