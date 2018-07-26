<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job\TypeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobType;

    public function setJobType(TypeInterface $jobType): self
    {
        if ($this->hasJobType()) {
            throw new \LogicException('NeighborhoodsKojoJobType is already set.');
        }
        $this->NeighborhoodsKojoJobType = $jobType;

        return $this;
    }

    protected function getJobType(): TypeInterface
    {
        if (!$this->hasJobType()) {
            throw new \LogicException('NeighborhoodsKojoJobType is not set.');
        }

        return $this->NeighborhoodsKojoJobType;
    }

    protected function hasJobType(): bool
    {
        return isset($this->NeighborhoodsKojoJobType);
    }

    protected function unsetJobType(): self
    {
        if (!$this->hasJobType()) {
            throw new \LogicException('NeighborhoodsKojoJobType is not set.');
        }
        unset($this->NeighborhoodsKojoJobType);

        return $this;
    }
}
