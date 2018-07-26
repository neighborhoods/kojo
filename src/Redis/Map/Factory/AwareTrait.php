<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Map\Factory;

use Neighborhoods\Kojo\Redis\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoRedisMapFactory;

    public function setRedisMapFactory(FactoryInterface $redisMapFactory): self
    {
        if ($this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoRedisMapFactory is already set.');
        }
        $this->NeighborhoodsKojoRedisMapFactory = $redisMapFactory;

        return $this;
    }

    protected function getRedisMapFactory(): FactoryInterface
    {
        if (!$this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoRedisMapFactory is not set.');
        }

        return $this->NeighborhoodsKojoRedisMapFactory;
    }

    protected function hasRedisMapFactory(): bool
    {
        return isset($this->NeighborhoodsKojoRedisMapFactory);
    }

    protected function unsetRedisMapFactory(): self
    {
        if (!$this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsKojoRedisMapFactory is not set.');
        }
        unset($this->NeighborhoodsKojoRedisMapFactory);

        return $this;
    }
}
