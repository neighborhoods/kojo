<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Maintainer;

use Neighborhoods\Kojo\MaintainerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoMaintainer;

    public function setMaintainer(MaintainerInterface $maintainer): self
    {
        if ($this->hasMaintainer()) {
            throw new \LogicException('NeighborhoodsKojoMaintainer is already set.');
        }
        $this->NeighborhoodsKojoMaintainer = $maintainer;

        return $this;
    }

    protected function getMaintainer(): MaintainerInterface
    {
        if (!$this->hasMaintainer()) {
            throw new \LogicException('NeighborhoodsKojoMaintainer is not set.');
        }

        return $this->NeighborhoodsKojoMaintainer;
    }

    protected function hasMaintainer(): bool
    {
        return isset($this->NeighborhoodsKojoMaintainer);
    }

    protected function unsetMaintainer(): self
    {
        if (!$this->hasMaintainer()) {
            throw new \LogicException('NeighborhoodsKojoMaintainer is not set.');
        }
        unset($this->NeighborhoodsKojoMaintainer);

        return $this;
    }
}
