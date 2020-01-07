<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\FromArrayBuilder\Factory;

use Neighborhoods\Kojo\Data\Job\FromArrayBuilder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDataJobFromArrayBuilderFactory;

    public function setDataJobFromArrayBuilderFactory(FactoryInterface $dataJobFromArrayBuilderFactory) : self
    {
        if ($this->hasDataJobFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoDataJobFromArrayBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoDataJobFromArrayBuilderFactory = $dataJobFromArrayBuilderFactory;

        return $this;
    }

    protected function getDataJobFromArrayBuilderFactory() : FactoryInterface
    {
        if (!$this->hasDataJobFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoDataJobFromArrayBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoDataJobFromArrayBuilderFactory;
    }

    protected function hasDataJobFromArrayBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoDataJobFromArrayBuilderFactory);
    }

    protected function unsetDataJobFromArrayBuilderFactory() : self
    {
        if (!$this->hasDataJobFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoDataJobFromArrayBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoDataJobFromArrayBuilderFactory);

        return $this;
    }
}
