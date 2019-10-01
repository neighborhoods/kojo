<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data;

use Neighborhoods\Kojo\JobStateChange\DataInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChangeData;

    public function setJobStateChangeData(DataInterface $JobStateChangeData) : self
    {
        if ($this->hasJobStateChangeData()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeData is already set.');
        }
        $this->NeighborhoodsKojoJobStateChangeData = $JobStateChangeData;

        return $this;
    }

    protected function getJobStateChangeData() : DataInterface
    {
        if (!$this->hasJobStateChangeData()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeData is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChangeData;
    }

    protected function hasJobStateChangeData() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChangeData);
    }

    protected function unsetJobStateChangeData() : self
    {
        if (!$this->hasJobStateChangeData()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChangeData is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChangeData);

        return $this;
    }
}
