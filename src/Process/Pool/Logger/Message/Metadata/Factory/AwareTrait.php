<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Factory;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory;

    public function setProcessPoolLoggerMessageMetadataFactory(
        FactoryInterface $ProcessPoolLoggerMessageMetadataFactory
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory = $ProcessPoolLoggerMessageMetadataFactory;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataFactory() : FactoryInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory;
    }

    protected function hasProcessPoolLoggerMessageMetadataFactory() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory);
    }

    protected function unsetProcessPoolLoggerMessageMetadataFactory() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataFactory()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataFactory);

        return $this;
    }
}
