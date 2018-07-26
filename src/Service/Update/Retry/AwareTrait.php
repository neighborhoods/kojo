<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Retry;

use Neighborhoods\Kojo\Service\Update\RetryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateRetry;

    public function setServiceUpdateRetry(RetryInterface $serviceUpdateRetry): self
    {
        if ($this->hasServiceUpdateRetry()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateRetry is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateRetry = $serviceUpdateRetry;

        return $this;
    }

    protected function getServiceUpdateRetry(): RetryInterface
    {
        if (!$this->hasServiceUpdateRetry()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateRetry is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateRetry;
    }

    protected function hasServiceUpdateRetry(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateRetry);
    }

    protected function unsetServiceUpdateRetry(): self
    {
        if (!$this->hasServiceUpdateRetry()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateRetry is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateRetry);

        return $this;
    }
}
