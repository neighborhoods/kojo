<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder;

    public function setProcessPoolLoggerMessageMetadataHostBuilder(
        BuilderInterface $ProcessPoolLoggerMessageMetadataHostBuilder
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataHostBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder = $ProcessPoolLoggerMessageMetadataHostBuilder;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataHostBuilder() : BuilderInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder;
    }

    protected function hasProcessPoolLoggerMessageMetadataHostBuilder() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder);
    }

    protected function unsetProcessPoolLoggerMessageMetadataHostBuilder() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostBuilder()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostBuilder);

        return $this;
    }
}
