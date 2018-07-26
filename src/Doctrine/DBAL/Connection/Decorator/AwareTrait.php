<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDoctrineDBALConnectionDecorator;

    public function setDoctrineDBALConnectionDecorator(DecoratorInterface $doctrineDBALConnectionDecorator): self
    {
        if ($this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecorator is already set.');
        }
        $this->NeighborhoodsKojoDoctrineDBALConnectionDecorator = $doctrineDBALConnectionDecorator;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecorator(): DecoratorInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecorator is not set.');
        }

        return $this->NeighborhoodsKojoDoctrineDBALConnectionDecorator;
    }

    protected function hasDoctrineDBALConnectionDecorator(): bool
    {
        return isset($this->NeighborhoodsKojoDoctrineDBALConnectionDecorator);
    }

    protected function unsetDoctrineDBALConnectionDecorator(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecorator is not set.');
        }
        unset($this->NeighborhoodsKojoDoctrineDBALConnectionDecorator);

        return $this;
    }
}
