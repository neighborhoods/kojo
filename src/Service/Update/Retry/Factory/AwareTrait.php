<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Retry\Factory;

use Neighborhoods\Kojo\Service\Update\Retry\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateRetryFactory;

    public function setServiceUpdateRetryFactory(FactoryInterface $serviceUpdateRetryFactory): self
    {
        if ($this->hasServiceUpdateRetryFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateRetryFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateRetryFactory = $serviceUpdateRetryFactory;

        return $this;
    }

    protected function getServiceUpdateRetryFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateRetryFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateRetryFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateRetryFactory;
    }

    protected function hasServiceUpdateRetryFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateRetryFactory);
    }

    protected function unsetServiceUpdateRetryFactory(): self
    {
        if (!$this->hasServiceUpdateRetryFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateRetryFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateRetryFactory);

        return $this;
    }
}
