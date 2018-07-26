<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\State\Service;

use Neighborhoods\Kojo\State\ServiceInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoStateService;

    public function setStateService(ServiceInterface $stateService): self
    {
        if ($this->hasStateService()) {
            throw new \LogicException('NeighborhoodsKojoStateService is already set.');
        }
        $this->NeighborhoodsKojoStateService = $stateService;

        return $this;
    }

    protected function getStateService(): ServiceInterface
    {
        if (!$this->hasStateService()) {
            throw new \LogicException('NeighborhoodsKojoStateService is not set.');
        }

        return $this->NeighborhoodsKojoStateService;
    }

    protected function hasStateService(): bool
    {
        return isset($this->NeighborhoodsKojoStateService);
    }

    protected function unsetStateService(): self
    {
        if (!$this->hasStateService()) {
            throw new \LogicException('NeighborhoodsKojoStateService is not set.');
        }
        unset($this->NeighborhoodsKojoStateService);

        return $this;
    }
}
