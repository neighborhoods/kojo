<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash;

use Neighborhoods\Kojo\Service\Update\CrashInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoServiceUpdateCrash;

    public function setServiceUpdateCrash(CrashInterface $serviceUpdateCrash): self
    {
        if ($this->hasServiceUpdateCrash()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCrash is already set.');
        }
        $this->NeighborhoodsKojoServiceUpdateCrash = $serviceUpdateCrash;

        return $this;
    }

    protected function getServiceUpdateCrash(): CrashInterface
    {
        if (!$this->hasServiceUpdateCrash()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCrash is not set.');
        }

        return $this->NeighborhoodsKojoServiceUpdateCrash;
    }

    protected function hasServiceUpdateCrash(): bool
    {
        return isset($this->NeighborhoodsKojoServiceUpdateCrash);
    }

    protected function unsetServiceUpdateCrash(): self
    {
        if (!$this->hasServiceUpdateCrash()) {
            throw new \LogicException('NeighborhoodsKojoServiceUpdateCrash is not set.');
        }
        unset($this->NeighborhoodsKojoServiceUpdateCrash);

        return $this;
    }
}
