<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder\Factory;

use Neighborhoods\Kojo\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoPDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        if ($this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoPDOBuilderFactory is already set.');
        }
        $this->NeighborhoodsKojoPDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoPDOBuilderFactory is not set.');
        }

        return $this->NeighborhoodsKojoPDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsKojoPDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsKojoPDOBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsKojoPDOBuilderFactory);

        return $this;
    }
}
