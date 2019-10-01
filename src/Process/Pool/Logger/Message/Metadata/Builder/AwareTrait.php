<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder;

    public function setProcessPoolLoggerMessageMetadataBuilder(
        BuilderInterface $ProcessPoolLoggerMessageMetadataBuilder
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder = $ProcessPoolLoggerMessageMetadataBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataBuilder() : BuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder;
    }

    protected function hasProcessPoolLoggerMessageMetadataBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder);
    }

    protected function unsetProcessPoolLoggerMessageMetadataBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataBuilder);

        return $this;
    }
}
