<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema\Version;

use Neighborhoods\Kojo\Db\Schema\VersionInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDbSchemaVersion;

    public function setDbSchemaVersion(VersionInterface $dbSchemaVersion): self
    {
        if ($this->hasDbSchemaVersion()) {
            throw new \LogicException('NeighborhoodsKojoDbSchemaVersion is already set.');
        }
        $this->NeighborhoodsKojoDbSchemaVersion = $dbSchemaVersion;

        return $this;
    }

    protected function getDbSchemaVersion(): VersionInterface
    {
        if (!$this->hasDbSchemaVersion()) {
            throw new \LogicException('NeighborhoodsKojoDbSchemaVersion is not set.');
        }

        return $this->NeighborhoodsKojoDbSchemaVersion;
    }

    protected function hasDbSchemaVersion(): bool
    {
        return isset($this->NeighborhoodsKojoDbSchemaVersion);
    }

    protected function unsetDbSchemaVersion(): self
    {
        if (!$this->hasDbSchemaVersion()) {
            throw new \LogicException('NeighborhoodsKojoDbSchemaVersion is not set.');
        }
        unset($this->NeighborhoodsKojoDbSchemaVersion);

        return $this;
    }
}
