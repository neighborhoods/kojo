<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Ask\Factory;

use Neighborhoods\Kojo\Ask\FactoryInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoAskFactory;

    public function setAskFactory(FactoryInterface $AskFactory): self
    {
        if ($this->hasAskFactory()) {
            throw new \LogicException('NeighborhoodsKojoAskFactory is already set.');
        }
        $this->NeighborhoodsKojoAskFactory = $AskFactory;

        return $this;
    }

    protected function getAskFactory(): FactoryInterface
    {
        if (!$this->hasAskFactory()) {
            throw new \LogicException('NeighborhoodsKojoAskFactory is not set.');
        }

        return $this->NeighborhoodsKojoAskFactory;
    }

    protected function hasAskFactory(): bool
    {
        return isset($this->NeighborhoodsKojoAskFactory);
    }

    protected function unsetAskFactory(): self
    {
        if (!$this->hasAskFactory()) {
            throw new \LogicException('NeighborhoodsKojoAskFactory is not set.');
        }
        unset($this->NeighborhoodsKojoAskFactory);

        return $this;
    }
}
