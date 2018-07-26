<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray;

    public function setDoctrineDBALConnectionDecoratorArray(
        DecoratorArrayInterface $doctrineDBALConnectionDecoratorArray
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorArray()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray is already set.');
        }
        $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray = $doctrineDBALConnectionDecoratorArray;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorArray(): DecoratorArrayInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorArray()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray is not set.');
        }

        return $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray;
    }

    protected function hasDoctrineDBALConnectionDecoratorArray(): bool
    {
        return isset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray);
    }

    protected function unsetDoctrineDBALConnectionDecoratorArray(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorArray()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray is not set.');
        }
        unset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArray);

        return $this;
    }
}
