<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\JobStateChangeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsKojoJobStateChange;

    public function setJobStateChange(JobStateChangeInterface $JobStateChange) : self
    {
        if ($this->hasJobStateChange()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChange is already set.');
        }
        $this->NeighborhoodsKojoJobStateChange = $JobStateChange;

        return $this;
    }

    protected function getJobStateChange() : JobStateChangeInterface
    {
        if (!$this->hasJobStateChange()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChange is not set.');
        }

        return $this->NeighborhoodsKojoJobStateChange;
    }

    protected function hasJobStateChange() : bool
    {
        return isset($this->NeighborhoodsKojoJobStateChange);
    }

    protected function unsetJobStateChange() : self
    {
        if (!$this->hasJobStateChange()) {
            throw new \LogicException('NeighborhoodsKojoJobStateChange is not set.');
        }
        unset($this->NeighborhoodsKojoJobStateChange);

        return $this;
    }
}
