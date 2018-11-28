<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Ask;

use Neighborhoods\Kojo\AskInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoAsk;

    public function setAsk(AskInterface $Ask): self
    {
        if ($this->hasAsk()) {
            throw new \LogicException('NeighborhoodsKojoAsk is already set.');
        }
        $this->NeighborhoodsKojoAsk = $Ask;

        return $this;
    }

    protected function getAsk(): AskInterface
    {
        if (!$this->hasAsk()) {
            throw new \LogicException('NeighborhoodsKojoAsk is not set.');
        }

        return $this->NeighborhoodsKojoAsk;
    }

    protected function hasAsk(): bool
    {
        return isset($this->NeighborhoodsKojoAsk);
    }

    protected function unsetAsk(): self
    {
        if (!$this->hasAsk()) {
            throw new \LogicException('NeighborhoodsKojoAsk is not set.');
        }
        unset($this->NeighborhoodsKojoAsk);

        return $this;
    }
}
