<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed;

use Neighborhoods\Kojo\Service\Update\Complete\FailedInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCompleteFailed;

    public function setServiceUpdateCompleteFailed(FailedInterface $serviceUpdateCompleteFailed): self
    {
        if ($this->hasServiceUpdateCompleteFailed()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailed is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCompleteFailed = $serviceUpdateCompleteFailed;

        return $this;
    }

    protected function getServiceUpdateCompleteFailed(): FailedInterface
    {
        if (!$this->hasServiceUpdateCompleteFailed()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailed is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCompleteFailed;
    }

    protected function hasServiceUpdateCompleteFailed(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCompleteFailed);
    }

    protected function unsetServiceUpdateCompleteFailed(): self
    {
        if (!$this->hasServiceUpdateCompleteFailed()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteFailed is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCompleteFailed);

        return $this;
    }
}
