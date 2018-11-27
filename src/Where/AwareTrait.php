<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

use Neighborhoods\Kojo\WhereInterface;

trait AwareTrait
{
    protected $NeighborhoodsKojoWhere;

    public function setWhere(WhereInterface $where): self
    {
        if ($this->hasWhere()) {
            throw new \LogicException('NeighborhoodsKojoWhere is already set.');
        }
        $this->NeighborhoodsKojoWhere = $where;

        return $this;
    }

    protected function getWhere(): WhereInterface
    {
        if (!$this->hasWhere()) {
            throw new \LogicException('NeighborhoodsKojoWhere is not set.');
        }

        return $this->NeighborhoodsKojoWhere;
    }

    protected function hasWhere(): bool
    {
        return isset($this->NeighborhoodsKojoWhere);
    }

    protected function unsetWhere(): self
    {
        if (!$this->hasWhere()) {
            throw new \LogicException('NeighborhoodsKojoWhere is not set.');
        }
        unset($this->NeighborhoodsKojoWhere);

        return $this;
    }
}
