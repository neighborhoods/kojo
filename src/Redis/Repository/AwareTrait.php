<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Repository;

use Neighborhoods\Kojo\Redis\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoRedisRepository;

    public function setRedisRepository(RepositoryInterface $redisRepository): self
    {
        if ($this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsKojoRedisRepository is already set.');
        }
        $this->NeighborhoodsKojoRedisRepository = $redisRepository;

        return $this;
    }

    protected function getRedisRepository(): RepositoryInterface
    {
        if (!$this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsKojoRedisRepository is not set.');
        }

        return $this->NeighborhoodsKojoRedisRepository;
    }

    protected function hasRedisRepository(): bool
    {
        return isset($this->NeighborhoodsKojoRedisRepository);
    }

    protected function unsetRedisRepository(): self
    {
        if (!$this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsKojoRedisRepository is not set.');
        }
        unset($this->NeighborhoodsKojoRedisRepository);

        return $this;
    }
}
