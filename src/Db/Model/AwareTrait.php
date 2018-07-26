<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Model;

use Neighborhoods\Kojo\Db\ModelInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoDbModel;

    public function setDbModel(ModelInterface $dbModel): self
    {
        if ($this->hasDbModel()) {
            throw new \LogicException('NeighborhoodsKojoDbModel is already set.');
        }
        $this->NeighborhoodsKojoDbModel = $dbModel;

        return $this;
    }

    protected function getDbModel(): ModelInterface
    {
        if (!$this->hasDbModel()) {
            throw new \LogicException('NeighborhoodsKojoDbModel is not set.');
        }

        return $this->NeighborhoodsKojoDbModel;
    }

    protected function hasDbModel(): bool
    {
        return isset($this->NeighborhoodsKojoDbModel);
    }

    protected function unsetDbModel(): self
    {
        if (!$this->hasDbModel()) {
            throw new \LogicException('NeighborhoodsKojoDbModel is not set.');
        }
        unset($this->NeighborhoodsKojoDbModel);

        return $this;
    }
}
