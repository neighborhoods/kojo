<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Builder\Factory;

use Neighborhoods\Kojo\Job\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobBuilderFactory;

    public function setJobBuilderFactory(FactoryInterface $jobBuilderFactory): self
    {
        if ($this->hasJobBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoJobBuilderFactory = $jobBuilderFactory;

        return $this;
    }

    protected function getJobBuilderFactory(): FactoryInterface
    {
        if (!$this->hasJobBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoJobBuilderFactory;
    }

    protected function hasJobBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsKojoJobBuilderFactory);
    }

    protected function unsetJobBuilderFactory(): self
    {
        if (!$this->hasJobBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoJobBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoJobBuilderFactory);

        return $this;
    }
}
