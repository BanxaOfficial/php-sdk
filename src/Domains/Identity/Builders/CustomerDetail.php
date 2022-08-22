<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

class CustomerDetail
{
    /**
     * @param string $accountReference
     * @param string $mobileNumber
     * @param string $emailAddress
     */
    public function __construct(
        private string $accountReference,
        private string $mobileNumber,
        private string $emailAddress)
    {
    }

    /**
     * @param string $accountReference
     * @param string $mobileNumber
     * @param string $emailAddress
     * @return static
     */
    public static function create(string $accountReference, string $mobileNumber, string $emailAddress): static
    {
        return new static($accountReference, $mobileNumber, $emailAddress);
    }

    /**
     * @return string
     */
    public function getAccountReference(): string
    {
        return $this->accountReference;
    }

    /**
     * @return string
     */
    public function getMobileNumber(): string
    {
        return $this->mobileNumber;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}