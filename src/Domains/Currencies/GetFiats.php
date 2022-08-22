<?php

namespace Banxa\Domains\Currencies;

use Banxa\Domains\Domain;

class GetFiats extends Domain
{
    private const BUY_MODE = 'buy';

    private const SELL_MODE = 'sell';

    /**
     * @var string
     */
    private string $path = 'api/fiats';

    /**
     * @var string|null
     */
    private null|string $mode = null;


    /**
     * @return string
     */
    protected function buildPath(): string
    {
        return $this->mode ? $this->path . DIRECTORY_SEPARATOR . $this->mode : $this->path;
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->buildPath();
    }

    /**
     * @return $this
     */
    public function setBuyMode(): static
    {
        $this->mode = self::BUY_MODE;
        return $this;
    }

    /**
     * @return $this
     */
    public function setSellMode(): static
    {
        $this->mode = self::SELL_MODE;
        return $this;
    }
}