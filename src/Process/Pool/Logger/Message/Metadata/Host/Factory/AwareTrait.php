<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory;

    public function setProcessPoolLoggerMessageMetadataHostFactory(
        FactoryInterface $ProcessPoolLoggerMessageMetadataHostFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataHostFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory = $ProcessPoolLoggerMessageMetadataHostFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataHostFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory;
    }

    protected function hasProcessPoolLoggerMessageMetadataHostFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory);
    }

    protected function unsetProcessPoolLoggerMessageMetadataHostFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHostFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHostFactory);

        return $this;
    }
}
