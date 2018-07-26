<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Selector;

use Neighborhoods\Kojo\SelectorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoSelector;

    public function setSelector(SelectorInterface $selector): self
    {
        if ($this->hasSelector()) {
            throw new \LogicException('NeighborhoodsKojoSelector is already set.');
        }
        $this->NeighborhoodsKojoSelector = $selector;

        return $this;
    }

    protected function getSelector(): SelectorInterface
    {
        if (!$this->hasSelector()) {
            throw new \LogicException('NeighborhoodsKojoSelector is not set.');
        }

        return $this->NeighborhoodsKojoSelector;
    }

    protected function hasSelector(): bool
    {
        return isset($this->NeighborhoodsKojoSelector);
    }

    protected function unsetSelector(): self
    {
        if (!$this->hasSelector()) {
            throw new \LogicException('NeighborhoodsKojoSelector is not set.');
        }
        unset($this->NeighborhoodsKojoSelector);

        return $this;
    }
}
