<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Apm\NewRelic;

use Neighborhoods\Kojo\Apm\NewRelicInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApmNewRelic;

    public function setApmNewRelic(NewRelicInterface $apmNewRelic): self
    {
        if ($this->hasApmNewRelic()) {
            throw new \LogicException('NeighborhoodsKojoApmNewRelic is already set.');
        }
        $this->NeighborhoodsKojoApmNewRelic = $apmNewRelic;

        return $this;
    }

    protected function getApmNewRelic(): NewRelicInterface
    {
        if (!$this->hasApmNewRelic()) {
            throw new \LogicException('NeighborhoodsKojoApmNewRelic is not set.');
        }

        return $this->NeighborhoodsKojoApmNewRelic;
    }

    protected function hasApmNewRelic(): bool
    {
        return isset($this->NeighborhoodsKojoApmNewRelic);
    }

    protected function unsetApmNewRelic(): self
    {
        if (!$this->hasApmNewRelic()) {
            throw new \LogicException('NeighborhoodsKojoApmNewRelic is not set.');
        }
        unset($this->NeighborhoodsKojoApmNewRelic);

        return $this;
    }
}
