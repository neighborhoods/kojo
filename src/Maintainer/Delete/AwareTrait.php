<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Maintainer\Delete;

use Neighborhoods\Kojo\Maintainer\DeleteInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoMaintainerDelete;

    public function setMaintainerDelete(DeleteInterface $maintainerDelete): self
    {
        if ($this->hasMaintainerDelete()) {
            throw new \LogicException('NeighborhoodsKojoMaintainerDelete is already set.');
        }
        $this->NeighborhoodsKojoMaintainerDelete = $maintainerDelete;

        return $this;
    }

    protected function getMaintainerDelete(): DeleteInterface
    {
        if (!$this->hasMaintainerDelete()) {
            throw new \LogicException('NeighborhoodsKojoMaintainerDelete is not set.');
        }

        return $this->NeighborhoodsKojoMaintainerDelete;
    }

    protected function hasMaintainerDelete(): bool
    {
        return isset($this->NeighborhoodsKojoMaintainerDelete);
    }

    protected function unsetMaintainerDelete(): self
    {
        if (!$this->hasMaintainerDelete()) {
            throw new \LogicException('NeighborhoodsKojoMaintainerDelete is not set.');
        }
        unset($this->NeighborhoodsKojoMaintainerDelete);

        return $this;
    }
}
