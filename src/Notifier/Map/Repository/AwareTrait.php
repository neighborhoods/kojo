<?php

namespace Neighborhoods\Kojo\Notifier\Map\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierMapRepository = null;

    public function setRETS1NotifierMapRepository(\Neighborhoods\Kojo\Notifier\Map\RepositoryInterface $RETS1NotifierMapRepository) : self
    {
        if ($this->hasRETS1NotifierMapRepository()) {
            throw new \LogicException('RETS1NotifierMapRepository is already set.');
        }
        $this->RETS1NotifierMapRepository = $RETS1NotifierMapRepository;

        return $this;
    }

    protected function getRETS1NotifierMapRepository() : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface
    {
        if (!$this->hasRETS1NotifierMapRepository()) {
            throw new \LogicException('RETS1NotifierMapRepository is not set.');
        }

        return $this->RETS1NotifierMapRepository;
    }

    protected function hasRETS1NotifierMapRepository() : bool
    {
        return isset($this->RETS1NotifierMapRepository);
    }

    protected function unsetRETS1NotifierMapRepository() : self
    {
        if (!$this->hasRETS1NotifierMapRepository()) {
            throw new \LogicException('RETS1NotifierMapRepository is not set.');
        }
        unset($this->RETS1NotifierMapRepository);

        return $this;
    }


}

