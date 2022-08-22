<?php


namespace Banxa\Domains\Currencies;

use Banxa\Domains\Domain;

class GetCryptoCurrencies extends Domain
{

    private const BUY_MODE = 'buy';

    private const SELL_MODE = 'sell';
    /**
     * @var string
     */
    private string $path = 'api/coins';
    /**
     * @var string|null
     */
    private string|null $mode = null;

    /**
     * @return string
     */
    private function buildPath(): string
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
        $this->mode = self::SELL_MODE;
        return $this;
    }

    /**
     * @return $this
     */
    public function setSellMode(): static
    {
        $this->mode = self::BUY_MODE;
        return $this;
    }
}