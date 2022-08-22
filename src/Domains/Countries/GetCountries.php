<?php

namespace Banxa\Domains\Countries;

use Banxa\Domains\Domain;

class GetCountries extends Domain
{

    /**
     * @var string
     */
    private string $path = 'api/countries';

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->path;
    }
}