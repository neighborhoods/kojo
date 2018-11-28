<?php

namespace Neighborhoods\Kojo\Notification\Map\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotificationMapRepository = null;

    public function setAskNotificationMapRepository(\Neighborhoods\Kojo\Notification\Map\RepositoryInterface $AskNotificationMapRepository) : self
    {
        if ($this->hasAskNotificationMapRepository()) {
            throw new \LogicException('AskNotificationMapRepository is already set.');
        }
        $this->AskNotificationMapRepository = $AskNotificationMapRepository;

        return $this;
    }

    protected function getAskNotificationMapRepository() : \Neighborhoods\Kojo\Notification\Map\RepositoryInterface
    {
        if (!$this->hasAskNotificationMapRepository()) {
            throw new \LogicException('AskNotificationMapRepository is not set.');
        }

        return $this->AskNotificationMapRepository;
    }

    protected function hasAskNotificationMapRepository() : bool
    {
        return isset($this->AskNotificationMapRepository);
    }

    protected function unsetAskNotificationMapRepository() : self
    {
        if (!$this->hasAskNotificationMapRepository()) {
            throw new \LogicException('AskNotificationMapRepository is not set.');
        }
        unset($this->AskNotificationMapRepository);

        return $this;
    }


}

