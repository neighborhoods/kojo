<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work;

use Neighborhoods\Kojo\Service\Update\WorkInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateWork;

    public function setServiceUpdateWork(WorkInterface $serviceUpdateWork): self
    {
        if ($this->hasServiceUpdateWork()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWork is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateWork = $serviceUpdateWork;

        return $this;
    }

    protected function getServiceUpdateWork(): WorkInterface
    {
        if (!$this->hasServiceUpdateWork()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWork is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateWork;
    }

    protected function hasServiceUpdateWork(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateWork);
    }

    protected function unsetServiceUpdateWork(): self
    {
        if (!$this->hasServiceUpdateWork()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWork is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateWork);

        return $this;
    }
}
