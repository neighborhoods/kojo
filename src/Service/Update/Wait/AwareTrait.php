<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Wait;

use Neighborhoods\Kojo\Service\Update\WaitInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateWait;

    public function setServiceUpdateWait(WaitInterface $serviceUpdateWait): self
    {
        if ($this->hasServiceUpdateWait()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWait is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateWait = $serviceUpdateWait;

        return $this;
    }

    protected function getServiceUpdateWait(): WaitInterface
    {
        if (!$this->hasServiceUpdateWait()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWait is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateWait;
    }

    protected function hasServiceUpdateWait(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateWait);
    }

    protected function unsetServiceUpdateWait(): self
    {
        if (!$this->hasServiceUpdateWait()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateWait is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateWait);

        return $this;
    }
}
