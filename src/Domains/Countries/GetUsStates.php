<?php

namespace Banxa\Domains\Countries;

use Banxa\Domains\Domain;

class GetUsStates extends Domain
{
    /**
     * @var string
     */
    private string $path = 'api/countries/us/states';

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->path;
    }
}