<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Factory;

use Neighborhoods\Kojo\Job\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobFactory;

    public function setJobFactory(FactoryInterface $jobFactory): self
    {
        if ($this->hasJobFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobFactory is already set.');
        }
        $this->NeighborhoodsKojoJobFactory = $jobFactory;

        return $this;
    }

    protected function getJobFactory(): FactoryInterface
    {
        if (!$this->hasJobFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobFactory;
    }

    protected function hasJobFactory(): bool
    {
        return isset($this->NeighborhoodsKojoJobFactory);
    }

    protected function unsetJobFactory(): self
    {
        if (!$this->hasJobFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobFactory);

        return $this;
    }
}
