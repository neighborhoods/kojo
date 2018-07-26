<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Logger;

use Neighborhoods\Kojo\LoggerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoLogger;

    public function setLogger(LoggerInterface $logger): self
    {
        if ($this->hasLogger()) {
            throw new \LogicException('NeighborhoodsKojoLogger is already set.');
        }
        $this->NeighborhoodsKojoLogger = $logger;

        return $this;
    }

    protected function getLogger(): LoggerInterface
    {
        if (!$this->hasLogger()) {
            throw new \LogicException('NeighborhoodsKojoLogger is not set.');
        }

        return $this->NeighborhoodsKojoLogger;
    }

    protected function hasLogger(): bool
    {
        return isset($this->NeighborhoodsKojoLogger);
    }

    protected function unsetLogger(): self
    {
        if (!$this->hasLogger()) {
            throw new \LogicException('NeighborhoodsKojoLogger is not set.');
        }
        unset($this->NeighborhoodsKojoLogger);

        return $this;
    }
}
