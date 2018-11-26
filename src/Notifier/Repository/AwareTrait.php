<?php

namespace Neighborhoods\Kojo\Notifier\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotifierRepository = null;

    public function setRETS1NotifierRepository(\Neighborhoods\Kojo\Notifier\RepositoryInterface $RETS1NotifierRepository) : self
    {
        if ($this->hasRETS1NotifierRepository()) {
            throw new \LogicException('RETS1NotifierRepository is already set.');
        }
        $this->RETS1NotifierRepository = $RETS1NotifierRepository;

        return $this;
    }

    protected function getRETS1NotifierRepository() : \Neighborhoods\Kojo\Notifier\RepositoryInterface
    {
        if (!$this->hasRETS1NotifierRepository()) {
            throw new \LogicException('RETS1NotifierRepository is not set.');
        }

        return $this->RETS1NotifierRepository;
    }

    protected function hasRETS1NotifierRepository() : bool
    {
        return isset($this->RETS1NotifierRepository);
    }

    protected function unsetRETS1NotifierRepository() : self
    {
        if (!$this->hasRETS1NotifierRepository()) {
            throw new \LogicException('RETS1NotifierRepository is not set.');
        }
        unset($this->RETS1NotifierRepository);

        return $this;
    }


}

