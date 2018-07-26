<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArray\Factory;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorArray\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory;

    public function setDoctrineDBALConnectionDecoratorArrayFactory(
        FactoryInterface $doctrineDBALConnectionDecoratorArrayFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorArrayFactory()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory is already set.');
        }
        $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory = $doctrineDBALConnectionDecoratorArrayFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorArrayFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorArrayFactory()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory is not set.');
        }

        return $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorArrayFactory(): bool
    {
        return isset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorArrayFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorArrayFactory()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory is not set.');
        }
        unset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorArrayFactory);

        return $this;
    }
}
