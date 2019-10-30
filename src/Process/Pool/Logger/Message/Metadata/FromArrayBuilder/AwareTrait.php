<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder;

    public function setProcessPoolLoggerMessageMetadataFromArrayBuilder(FromArrayBuilderInterface $processPoolLoggerMessageMetadataFromArrayBuilder) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder is already set.');
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder = $processPoolLoggerMessageMetadataFromArrayBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataFromArrayBuilder() : FromArrayBuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder is not set.');
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder;
    }

    protected function hasProcessPoolLoggerMessageMetadataFromArrayBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder);
    }

    protected function unsetProcessPoolLoggerMessageMetadataFromArrayBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataFromArrayBuilder()) {
            throw new \LogicException('NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFromArrayBuilder);

        return $this;
    }
}
