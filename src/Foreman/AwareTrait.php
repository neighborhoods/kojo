<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Foreman;

use Neighborhoods\Kojo\ForemanInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoForeman;

    public function setForeman(ForemanInterface $foreman): self
    {
        if ($this->hasForeman()) {
            throw new \LogicException('NeighborhoodsKojoForeman is already set.');
        }
        $this->NeighborhoodsKojoForeman = $foreman;

        return $this;
    }

    protected function getForeman(): ForemanInterface
    {
        if (!$this->hasForeman()) {
            throw new \LogicException('NeighborhoodsKojoForeman is not set.');
        }

        return $this->NeighborhoodsKojoForeman;
    }

    protected function hasForeman(): bool
    {
        return isset($this->NeighborhoodsKojoForeman);
    }

    protected function unsetForeman(): self
    {
        if (!$this->hasForeman()) {
            throw new \LogicException('NeighborhoodsKojoForeman is not set.');
        }
        unset($this->NeighborhoodsKojoForeman);

        return $this;
    }
}
