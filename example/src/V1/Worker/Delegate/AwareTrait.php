<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Delegate;

use Neighborhoods\KojoExample\V1\Worker\DelegateInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1WorkerDelegate;

    public function setV1WorkerDelegate(DelegateInterface $v1WorkerDelegate): self
    {
        assert(!$this->hasV1WorkerDelegate(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegate is already set.'));
        $this->NeighborhoodsKojoExampleV1WorkerDelegate = $v1WorkerDelegate;

        return $this;
    }

    protected function getV1WorkerDelegate(): DelegateInterface
    {
        assert($this->hasV1WorkerDelegate(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegate is not set.'));

        return $this->NeighborhoodsKojoExampleV1WorkerDelegate;
    }

    protected function hasV1WorkerDelegate(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1WorkerDelegate);
    }

    protected function unsetV1WorkerDelegate(): self
    {
        assert($this->hasV1WorkerDelegate(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegate is not set.'));
        unset($this->NeighborhoodsKojoExampleV1WorkerDelegate);

        return $this;
    }
}
