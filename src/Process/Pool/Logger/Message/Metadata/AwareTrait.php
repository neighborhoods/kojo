<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadata;

    public function setProcessPoolLoggerMessageMetadata(
        MetadataInterface $ProcessPoolLoggerMessageMetadata
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadata()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadata is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadata = $ProcessPoolLoggerMessageMetadata;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadata() : MetadataInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadata()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadata is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadata;
    }

    protected function hasProcessPoolLoggerMessageMetadata() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadata);
    }

    protected function unsetProcessPoolLoggerMessageMetadata() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadata()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadata is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadata);

        return $this;
    }
}
