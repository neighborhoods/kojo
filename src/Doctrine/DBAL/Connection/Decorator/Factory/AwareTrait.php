<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\Decorator\Factory;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory;

    public function setDoctrineDBALConnectionDecoratorFactory(FactoryInterface $doctrineDBALConnectionDecoratorFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory is already set.');
        }
        $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory = $doctrineDBALConnectionDecoratorFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory is not set.');
        }

        return $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorFactory(): bool
    {
        return isset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory is not set.');
        }
        unset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorFactory);

        return $this;
    }
}
