<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash\Factory;

use Neighborhoods\Kojo\Service\Update\Crash\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCrashFactory;

    public function setServiceUpdateCrashFactory(FactoryInterface $serviceUpdateCrashFactory): self
    {
        if ($this->hasServiceUpdateCrashFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCrashFactory is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCrashFactory = $serviceUpdateCrashFactory;

        return $this;
    }

    protected function getServiceUpdateCrashFactory(): FactoryInterface
    {
        if (!$this->hasServiceUpdateCrashFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCrashFactory is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCrashFactory;
    }

    protected function hasServiceUpdateCrashFactory(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCrashFactory);
    }

    protected function unsetServiceUpdateCrashFactory(): self
    {
        if (!$this->hasServiceUpdateCrashFactory()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCrashFactory is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCrashFactory);

        return $this;
    }
}
