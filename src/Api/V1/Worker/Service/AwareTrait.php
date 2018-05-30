<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Worker\Service;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoApiV1WorkerService;

    public function setApiV1WorkerService(ServiceInterface $apiV1WorkerService): self
    {
        assert(!$this->hasApiV1WorkerService(),
            new \LogicException('NeighborhoodsKojoApiV1WorkerService is already set.'));
        $this->NeighborhoodsKojoApiV1WorkerService = $apiV1WorkerService;

        return $this;
    }

    protected function getApiV1WorkerService(): ServiceInterface
    {
        assert($this->hasApiV1WorkerService(), new \LogicException('NeighborhoodsKojoApiV1WorkerService is not set.'));

        return $this->NeighborhoodsKojoApiV1WorkerService;
    }

    protected function hasApiV1WorkerService(): bool
    {
        return isset($this->NeighborhoodsKojoApiV1WorkerService);
    }

    protected function unsetApiV1WorkerService(): self
    {
        assert($this->hasApiV1WorkerService(), new \LogicException('NeighborhoodsKojoApiV1WorkerService is not set.'));
        unset($this->NeighborhoodsKojoApiV1WorkerService);

        return $this;
    }
}
