<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Model\Collection;

use Neighborhoods\Kojo\Db\Model\CollectionInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDbModelCollection;

    public function setDbModelCollection(CollectionInterface $dbModelCollection): self
    {
        if ($this->hasDbModelCollection()) {
            throw new \LogicException('NeighborhoodsKojoDbModelCollection is already set.');
        }
        $this->NeighborhoodsKojoDbModelCollection = $dbModelCollection;

        return $this;
    }

    protected function getDbModelCollection(): CollectionInterface
    {
        if (!$this->hasDbModelCollection()) {
            throw new \LogicException('NeighborhoodsKojoDbModelCollection is not set.');
        }

        return $this->NeighborhoodsKojoDbModelCollection;
    }

    protected function hasDbModelCollection(): bool
    {
        return isset($this->NeighborhoodsKojoDbModelCollection);
    }

    protected function unsetDbModelCollection(): self
    {
        if (!$this->hasDbModelCollection()) {
            throw new \LogicException('NeighborhoodsKojoDbModelCollection is not set.');
        }
        unset($this->NeighborhoodsKojoDbModelCollection);

        return $this;
    }
}
