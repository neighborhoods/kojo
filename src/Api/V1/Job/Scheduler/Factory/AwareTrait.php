<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler\Factory;

use Neighborhoods\Kojo\Api\V1\Job\Scheduler\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApiV1JobSchedulerFactory;

    public function setApiV1JobSchedulerFactory(FactoryInterface $apiV1JobSchedulerFactory): self
    {
        if ($this->hasApiV1JobSchedulerFactory()) {
            throw new \LogicException('NeighborhoodsKojoApiV1JobSchedulerFactory is already set.');
        }
        $this->NeighborhoodsKojoApiV1JobSchedulerFactory = $apiV1JobSchedulerFactory;

        return $this;
    }

    protected function getApiV1JobSchedulerFactory(): FactoryInterface
    {
        if (!$this->hasApiV1JobSchedulerFactory()) {
            throw new \LogicException('NeighborhoodsKojoApiV1JobSchedulerFactory is not set.');
        }

        return $this->NeighborhoodsKojoApiV1JobSchedulerFactory;
    }

    protected function hasApiV1JobSchedulerFactory(): bool
    {
        return isset($this->NeighborhoodsKojoApiV1JobSchedulerFactory);
    }

    protected function unsetApiV1JobSchedulerFactory(): self
    {
        if (!$this->hasApiV1JobSchedulerFactory()) {
            throw new \LogicException('NeighborhoodsKojoApiV1JobSchedulerFactory is not set.');
        }
        unset($this->NeighborhoodsKojoApiV1JobSchedulerFactory);

        return $this;
    }
}
