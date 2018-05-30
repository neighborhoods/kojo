<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Delegate\Repository;

use Neighborhoods\KojoExample\V1\Worker\Delegate\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1WorkerDelegateRepository;

    public function setV1WorkerDelegateRepository(RepositoryInterface $v1WorkerDelegateRepository): self
    {
        assert(!$this->hasV1WorkerDelegateRepository(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegateRepository is already set.'));
        $this->NeighborhoodsKojoExampleV1WorkerDelegateRepository = $v1WorkerDelegateRepository;

        return $this;
    }

    protected function getV1WorkerDelegateRepository(): RepositoryInterface
    {
        assert($this->hasV1WorkerDelegateRepository(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegateRepository is not set.'));

        return $this->NeighborhoodsKojoExampleV1WorkerDelegateRepository;
    }

    protected function hasV1WorkerDelegateRepository(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1WorkerDelegateRepository);
    }

    protected function unsetV1WorkerDelegateRepository(): self
    {
        assert($this->hasV1WorkerDelegateRepository(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegateRepository is not set.'));
        unset($this->NeighborhoodsKojoExampleV1WorkerDelegateRepository);

        return $this;
    }
}
