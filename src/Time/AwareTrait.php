<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Time;

use Neighborhoods\Kojo\TimeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoTime;

    public function setTime(TimeInterface $time): self
    {
        if ($this->hasTime()) {
            throw new \LogicException('NeighborhoodsKojoTime is already set.');
        }
        $this->NeighborhoodsKojoTime = $time;

        return $this;
    }

    protected function getTime(): TimeInterface
    {
        if (!$this->hasTime()) {
            throw new \LogicException('NeighborhoodsKojoTime is not set.');
        }

        return $this->NeighborhoodsKojoTime;
    }

    protected function hasTime(): bool
    {
        return isset($this->NeighborhoodsKojoTime);
    }

    protected function unsetTime(): self
    {
        if (!$this->hasTime()) {
            throw new \LogicException('NeighborhoodsKojoTime is not set.');
        }
        unset($this->NeighborhoodsKojoTime);

        return $this;
    }
}
