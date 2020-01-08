<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\FromArrayBuilder;

use Neighborhoods\Kojo\Data\Job\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobFromArrayBuilder;

    public function setDataJobFromArrayBuilder(FromArrayBuilderInterface $dataJobFromArrayBuilder) : self
    {
        if ($this->hasDataJobFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoDataJobFromArrayBuilder is already set.');
        }
        $this->NeighborhoodsKojoDataJobFromArrayBuilder = $dataJobFromArrayBuilder;

        return $this;
    }

    protected function getDataJobFromArrayBuilder() : FromArrayBuilderInterface
    {
        if (!$this->hasDataJobFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoDataJobFromArrayBuilder is not set.');
        }

        return $this->NeighborhoodsKojoDataJobFromArrayBuilder;
    }

    protected function hasDataJobFromArrayBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoDataJobFromArrayBuilder);
    }

    protected function unsetDataJobFromArrayBuilder() : self
    {
        if (!$this->hasDataJobFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoDataJobFromArrayBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobFromArrayBuilder);

        return $this;
    }
}
