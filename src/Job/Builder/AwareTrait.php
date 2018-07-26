<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Builder;

use Neighborhoods\Kojo\Job\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobBuilder;

    public function setJobBuilder(BuilderInterface $jobBuilder): self
    {
        if ($this->hasJobBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobBuilder is already set.');
        }
        $this->NeighborhoodsKojoJobBuilder = $jobBuilder;

        return $this;
    }

    protected function getJobBuilder(): BuilderInterface
    {
        if (!$this->hasJobBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobBuilder is not set.');
        }

        return $this->NeighborhoodsKojoJobBuilder;
    }

    protected function hasJobBuilder(): bool
    {
        return isset($this->NeighborhoodsKojoJobBuilder);
    }

    protected function unsetJobBuilder(): self
    {
        if (!$this->hasJobBuilder()) {
            throw new \LogicException('NeighborhoodsKojoJobBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoJobBuilder);

        return $this;
    }
}
