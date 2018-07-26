<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Logger;

use Neighborhoods\Kojo\Api\V1\LoggerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApiV1Logger;

    public function setApiV1Logger(LoggerInterface $apiV1Logger): self
    {
        if ($this->hasApiV1Logger()) {
            throw new \LogicException('NeighborhoodsKojoApiV1Logger is already set.');
        }
        $this->NeighborhoodsKojoApiV1Logger = $apiV1Logger;

        return $this;
    }

    protected function getApiV1Logger(): LoggerInterface
    {
        if (!$this->hasApiV1Logger()) {
            throw new \LogicException('NeighborhoodsKojoApiV1Logger is not set.');
        }

        return $this->NeighborhoodsKojoApiV1Logger;
    }

    protected function hasApiV1Logger(): bool
    {
        return isset($this->NeighborhoodsKojoApiV1Logger);
    }

    protected function unsetApiV1Logger(): self
    {
        if (!$this->hasApiV1Logger()) {
            throw new \LogicException('NeighborhoodsKojoApiV1Logger is not set.');
        }
        unset($this->NeighborhoodsKojoApiV1Logger);

        return $this;
    }
}
