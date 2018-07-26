<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup;

use Neighborhoods\Kojo\Db\SetupInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDbSetup;

    public function setDbSetup(SetupInterface $dbSetup): self
    {
        if ($this->hasDbSetup()) {
            throw new \LogicException('NeighborhoodsKojoDbSetup is already set.');
        }
        $this->NeighborhoodsKojoDbSetup = $dbSetup;

        return $this;
    }

    protected function getDbSetup(): SetupInterface
    {
        if (!$this->hasDbSetup()) {
            throw new \LogicException('NeighborhoodsKojoDbSetup is not set.');
        }

        return $this->NeighborhoodsKojoDbSetup;
    }

    protected function hasDbSetup(): bool
    {
        return isset($this->NeighborhoodsKojoDbSetup);
    }

    protected function unsetDbSetup(): self
    {
        if (!$this->hasDbSetup()) {
            throw new \LogicException('NeighborhoodsKojoDbSetup is not set.');
        }
        unset($this->NeighborhoodsKojoDbSetup);

        return $this;
    }
}
