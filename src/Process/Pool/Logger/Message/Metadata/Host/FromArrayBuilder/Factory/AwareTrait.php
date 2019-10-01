<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FromArrayBuilder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FromArrayBuilder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory;

    public function setProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory(FactoryInterface $processPoolLoggerMessageMetadataHostFromArrayBuilderFactory) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory = $processPoolLoggerMessageMetadataHostFromArrayBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory);

        return $this;
    }
}
