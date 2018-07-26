<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Map\Factory;

use Neighborhoods\Kojo\Job\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobMapFactory;

    public function setJobMapFactory(FactoryInterface $jobMapFactory): self
    {
        if ($this->hasJobMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobMapFactory is already set.');
        }
        $this->NeighborhoodsKojoJobMapFactory = $jobMapFactory;

        return $this;
    }

    protected function getJobMapFactory(): FactoryInterface
    {
        if (!$this->hasJobMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobMapFactory;
    }

    protected function hasJobMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoJobMapFactory);
    }

    protected function unsetJobMapFactory(): self
    {
        if (!$this->hasJobMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobMapFactory);

        return $this;
    }
}
