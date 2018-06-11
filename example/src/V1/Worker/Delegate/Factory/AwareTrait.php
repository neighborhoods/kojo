<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Delegate\Factory;

use Neighborhoods\KojoExample\V1\Worker\Delegate\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoExampleV1WorkerDelegateFactory;

    public function setV1WorkerDelegateFactory(FactoryInterface $v1WorkerDelegateFactory): self
    {
        assert(!$this->hasV1WorkerDelegateFactory(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegateFactory is already set.'));
        $this->NeighborhoodsKojoExampleV1WorkerDelegateFactory = $v1WorkerDelegateFactory;

        return $this;
    }

    protected function getV1WorkerDelegateFactory(): FactoryInterface
    {
        assert($this->hasV1WorkerDelegateFactory(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegateFactory is not set.'));

        return $this->NeighborhoodsKojoExampleV1WorkerDelegateFactory;
    }

    protected function hasV1WorkerDelegateFactory(): bool
    {
        return isset($this->NeighborhoodsKojoExampleV1WorkerDelegateFactory);
    }

    protected function unsetV1WorkerDelegateFactory(): self
    {
        assert($this->hasV1WorkerDelegateFactory(),
            new \LogicException('NeighborhoodsKojoExampleV1WorkerDelegateFactory is not set.'));
        unset($this->NeighborhoodsKojoExampleV1WorkerDelegateFactory);

        return $this;
    }
}
