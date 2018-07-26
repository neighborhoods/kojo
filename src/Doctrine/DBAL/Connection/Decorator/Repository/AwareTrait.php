<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Doctrine\DBAL\Connection\Decorator\Repository;

use Neighborhoods\Kojo\Doctrine\DBAL\Connection\Decorator\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository;

    public function setDoctrineDBALConnectionDecoratorRepository(
        RepositoryInterface $doctrineDBALConnectionDecoratorRepository
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository is already set.');
        }
        $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository = $doctrineDBALConnectionDecoratorRepository;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorRepository(): RepositoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository is not set.');
        }

        return $this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository;
    }

    protected function hasDoctrineDBALConnectionDecoratorRepository(): bool
    {
        return isset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository);
    }

    protected function unsetDoctrineDBALConnectionDecoratorRepository(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorRepository()) {
            throw new \LogicException('NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository is not set.');
        }
        unset($this->NeighborhoodsKojoDoctrineDBALConnectionDecoratorRepository);

        return $this;
    }
}
