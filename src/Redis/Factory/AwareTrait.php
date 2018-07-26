<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Factory;

use Neighborhoods\Kojo\Redis\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoRedisFactory;

    public function setRedisFactory(FactoryInterface $redisFactory): self
    {
        if ($this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsKojoRedisFactory is already set.');
        }
        $this->NeighborhoodsKojoRedisFactory = $redisFactory;

        return $this;
    }

    protected function getRedisFactory(): FactoryInterface
    {
        if (!$this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsKojoRedisFactory is not set.');
        }

        return $this->NeighborhoodsKojoRedisFactory;
    }

    protected function hasRedisFactory(): bool
    {
        return isset($this->NeighborhoodsKojoRedisFactory);
    }

    protected function unsetRedisFactory(): self
    {
        if (!$this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsKojoRedisFactory is not set.');
        }
        unset($this->NeighborhoodsKojoRedisFactory);

        return $this;
    }
}
