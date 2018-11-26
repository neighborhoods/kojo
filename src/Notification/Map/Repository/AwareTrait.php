<?php

namespace Neighborhoods\Kojo\Notification\Map\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $RETS1NotificationMapRepository = null;

    public function setRETS1NotificationMapRepository(\Neighborhoods\Kojo\Notification\Map\RepositoryInterface $RETS1NotificationMapRepository) : self
    {
        if ($this->hasRETS1NotificationMapRepository()) {
            throw new \LogicException('RETS1NotificationMapRepository is already set.');
        }
        $this->RETS1NotificationMapRepository = $RETS1NotificationMapRepository;

        return $this;
    }

    protected function getRETS1NotificationMapRepository() : \Neighborhoods\Kojo\Notification\Map\RepositoryInterface
    {
        if (!$this->hasRETS1NotificationMapRepository()) {
            throw new \LogicException('RETS1NotificationMapRepository is not set.');
        }

        return $this->RETS1NotificationMapRepository;
    }

    protected function hasRETS1NotificationMapRepository() : bool
    {
        return isset($this->RETS1NotificationMapRepository);
    }

    protected function unsetRETS1NotificationMapRepository() : self
    {
        if (!$this->hasRETS1NotificationMapRepository()) {
            throw new \LogicException('RETS1NotificationMapRepository is not set.');
        }
        unset($this->RETS1NotificationMapRepository);

        return $this;
    }


}

