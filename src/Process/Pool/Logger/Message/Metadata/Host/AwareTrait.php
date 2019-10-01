<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\HostInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost;

    public function setProcessPoolLoggerMessageMetadataHost(
        HostInterface $ProcessPoolLoggerMessageMetadataHost
    ) : self
    {
        if ($this->hasProcessPoolLoggerMessageMetadataHost()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost is already set.'
            );
        }
        $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost = $ProcessPoolLoggerMessageMetadataHost;

        return $this;
    }

    protected function getProcessPoolLoggerMessageMetadataHost() : HostInterface
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHost()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost is not set.'
            );
        }

        return $this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost;
    }

    protected function hasProcessPoolLoggerMessageMetadataHost() : bool
    {
        return isset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost);
    }

    protected function unsetProcessPoolLoggerMessageMetadataHost() : self
    {
        if (!$this->hasProcessPoolLoggerMessageMetadataHost()) {
            throw new \LogicException(
                'NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost is not set.'
            );
        }
        unset($this->NeighborhoodsKojoProcessPoolLoggerMessageMetadataHost);

        return $this;
    }
}
