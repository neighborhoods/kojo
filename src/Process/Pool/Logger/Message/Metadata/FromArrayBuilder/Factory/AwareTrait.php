<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilder\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory;

    public function setProcessPoolLoggerMessageMetadataFromArrayBuilderFactory(FactoryInterface $processPoolLoggerMessageMetadataFromArrayBuilderFactory) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory = $processPoolLoggerMessageMetadataFromArrayBuilderFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataFromArrayBuilderFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory;
    }

    protected function hasProcessPoolLoggerMessageMetadataFromArrayBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory);
    }

    protected function unsetProcessPoolLoggerMessageMetadataFromArrayBuilderFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataFromArrayBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilderFactory);

        return $this;
    }
}
