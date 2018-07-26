<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder;

use Neighborhoods\Kojo\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoPDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        if ($this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsKojoPDOBuilder is already set.');
        }
        $this->NeighborhoodsKojoPDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsKojoPDOBuilder is not set.');
        }

        return $this->NeighborhoodsKojoPDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->NeighborhoodsKojoPDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsKojoPDOBuilder is not set.');
        }
        unset($this->NeighborhoodsKojoPDOBuilder);

        return $this;
    }
}
