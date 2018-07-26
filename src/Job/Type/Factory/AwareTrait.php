<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type\Factory;

use Neighborhoods\Kojo\Job\Type\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobTypeFactory;

    public function setJobTypeFactory(FactoryInterface $jobTypeFactory): self
    {
        if ($this->hasJobTypeFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeFactory is already set.');
        }
        $this->NeighborhoodsKojoJobTypeFactory = $jobTypeFactory;

        return $this;
    }

    protected function getJobTypeFactory(): FactoryInterface
    {
        if (!$this->hasJobTypeFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobTypeFactory;
    }

    protected function hasJobTypeFactory(): bool
    {
        return isset($this->NeighborhoodsKojoJobTypeFactory);
    }

    protected function unsetJobTypeFactory(): self
    {
        if (!$this->hasJobTypeFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobTypeFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobTypeFactory);

        return $this;
    }
}
