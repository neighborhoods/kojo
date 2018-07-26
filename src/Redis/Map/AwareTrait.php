<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Redis\Map;

use Neighborhoods\Kojo\Redis\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoRedisMap;

    public function setRedisMap(MapInterface $redisMap): self
    {
        if ($this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsKojoRedisMap is already set.');
        }
        $this->NeighborhoodsKojoRedisMap = $redisMap;

        return $this;
    }

    protected function getRedisMap(): MapInterface
    {
        if (!$this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsKojoRedisMap is not set.');
        }

        return $this->NeighborhoodsKojoRedisMap;
    }

    protected function hasRedisMap(): bool
    {
        return isset($this->NeighborhoodsKojoRedisMap);
    }

    protected function unsetRedisMap(): self
    {
        if (!$this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsKojoRedisMap is not set.');
        }
        unset($this->NeighborhoodsKojoRedisMap);

        return $this;
    }
}
