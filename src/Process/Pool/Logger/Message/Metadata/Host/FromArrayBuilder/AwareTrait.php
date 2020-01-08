<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder;

    public function setProcessPoolLoggerMessageMetadataHostFromArrayBuilder(FromArrayBuilderInterface $processPoolLoggerMessageMetadataHostFromArrayBuilder) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataHostFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder = $processPoolLoggerMessageMetadataHostFromArrayBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataHostFromArrayBuilder() : FromArrayBuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder;
    }

    protected function hasProcessPoolLoggerMessageMetadataHostFromArrayBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder);
    }

    protected function unsetProcessPoolLoggerMessageMetadataHostFromArrayBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFromArrayBuilder);

        return $this;
    }
}
