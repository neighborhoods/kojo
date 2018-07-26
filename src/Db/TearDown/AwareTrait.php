<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown;

use Neighborhoods\Kojo\Db\TearDownInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDbTearDown;

    public function setDbTearDown(TearDownInterface $dbTearDown): self
    {
        if ($this->hasDbTearDown()) {
            throw new \LogicException('NeighborhoodsKojoDbTearDown is already set.');
        }
        $this->NeighborhoodsKojoDbTearDown = $dbTearDown;

        return $this;
    }

    protected function getDbTearDown(): TearDownInterface
    {
        if (!$this->hasDbTearDown()) {
            throw new \LogicException('NeighborhoodsKojoDbTearDown is not set.');
        }

        return $this->NeighborhoodsKojoDbTearDown;
    }

    protected function hasDbTearDown(): bool
    {
        return isset($this->NeighborhoodsKojoDbTearDown);
    }

    protected function unsetDbTearDown(): self
    {
        if (!$this->hasDbTearDown()) {
            throw new \LogicException('NeighborhoodsKojoDbTearDown is not set.');
        }
        unset($this->NeighborhoodsKojoDbTearDown);

        return $this;
    }
}
