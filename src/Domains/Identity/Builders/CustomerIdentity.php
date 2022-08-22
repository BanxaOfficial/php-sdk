<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

use Banxa\Library\KeyConstants;

/**
 *
 */
class CustomerIdentity
{
    /**
     * @param string $givenName
     * @param string $surname
     * @param string|null $dateOfBirth
     */
    public function __construct(
        private string $givenName,
        private string $surname,
        private string|null $dateOfBirth
    ) {
    }

    /**
     * @param string $givenName
     * @param string $surname
     * @param string|null $dateOfBirth
     * @return static
     */
    public static function create(string $givenName, string $surname, string|null $dateOfBirth = null): static
    {
        return new static($givenName, $surname, $dateOfBirth);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            KeyConstants::_GIVEN_NAME    => $this->getGivenName(),
            KeyConstants::_SURNAME       => $this->getSurname(),
            KeyConstants::_DATE_OF_BIRTH => $this->getDateOfBirth(),
        ];
    }

    /**
     * @return string
     */
    public function getGivenName(): string
    {
        return $this->givenName;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string|null
     */
    public function getDateOfBirth(): null|string
    {
        return $this->dateOfBirth;
    }

}