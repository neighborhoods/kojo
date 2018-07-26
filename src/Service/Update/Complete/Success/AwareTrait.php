<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success;

use Neighborhoods\Kojo\Service\Update\Complete\SuccessInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCompleteSuccess;

    public function setServiceUpdateCompleteSuccess(SuccessInterface $serviceUpdateCompleteSuccess): self
    {
        if ($this->hasServiceUpdateCompleteSuccess()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteSuccess is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCompleteSuccess = $serviceUpdateCompleteSuccess;

        return $this;
    }

    protected function getServiceUpdateCompleteSuccess(): SuccessInterface
    {
        if (!$this->hasServiceUpdateCompleteSuccess()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteSuccess is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCompleteSuccess;
    }

    protected function hasServiceUpdateCompleteSuccess(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCompleteSuccess);
    }

    protected function unsetServiceUpdateCompleteSuccess(): self
    {
        if (!$this->hasServiceUpdateCompleteSuccess()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCompleteSuccess is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCompleteSuccess);

        return $this;
    }
}
