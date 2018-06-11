<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Scheduler;

use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApiV1JobScheduler;

    public function setApiV1JobScheduler(SchedulerInterface $apiV1JobScheduler): self
    {
        assert(!$this->hasApiV1JobScheduler(),
            new \LogicException('NeighborhoodsKojoApiV1JobScheduler is already set.'));
        $this->NeighborhoodsKojoApiV1JobScheduler = $apiV1JobScheduler;

        return $this;
    }

    protected function getApiV1JobScheduler(): SchedulerInterface
    {
        assert($this->hasApiV1JobScheduler(), new \LogicException('NeighborhoodsKojoApiV1JobScheduler is not set.'));

        return $this->NeighborhoodsKojoApiV1JobScheduler;
    }

    protected function hasApiV1JobScheduler(): bool
    {
        return isset($this->NeighborhoodsKojoApiV1JobScheduler);
    }

    protected function unsetApiV1JobScheduler(): self
    {
        assert($this->hasApiV1JobScheduler(), new \LogicException('NeighborhoodsKojoApiV1JobScheduler is not set.'));
        unset($this->NeighborhoodsKojoApiV1JobScheduler);

        return $this;
    }
}
