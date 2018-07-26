<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema\Version\Map;

use Neighborhoods\Kojo\Db\Schema\Version\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDbSchemaVersionMap;

    public function setDbSchemaVersionMap(MapInterface $dbSchemaVersionMap): self
    {
        if ($this->hasDbSchemaVersionMap()) {
            throw new \LogicException('NeighborhoodsKojoDbSchemaVersionMap is already set.');
        }
        $this->NeighborhoodsKojoDbSchemaVersionMap = $dbSchemaVersionMap;

        return $this;
    }

    protected function getDbSchemaVersionMap(): MapInterface
    {
        if (!$this->hasDbSchemaVersionMap()) {
            throw new \LogicException('NeighborhoodsKojoDbSchemaVersionMap is not set.');
        }

        return $this->NeighborhoodsKojoDbSchemaVersionMap;
    }

    protected function hasDbSchemaVersionMap(): bool
    {
        return isset($this->NeighborhoodsKojoDbSchemaVersionMap);
    }

    protected function unsetDbSchemaVersionMap(): self
    {
        if (!$this->hasDbSchemaVersionMap()) {
            throw new \LogicException('NeighborhoodsKojoDbSchemaVersionMap is not set.');
        }
        unset($this->NeighborhoodsKojoDbSchemaVersionMap);

        return $this;
    }
}
