<?php

namespace Neighborhoods\Kojo\Notifier\Map\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierMapRepository = null;

    public function setAskNotifierMapRepository(\Neighborhoods\Kojo\Notifier\Map\RepositoryInterface $AskNotifierMapRepository) : self
    {
        if ($this->hasAskNotifierMapRepository()) {
            throw new \LogicException('AskNotifierMapRepository is already set.');
        }
        $this->AskNotifierMapRepository = $AskNotifierMapRepository;

        return $this;
    }

    protected function getAskNotifierMapRepository() : \Neighborhoods\Kojo\Notifier\Map\RepositoryInterface
    {
        if (!$this->hasAskNotifierMapRepository()) {
            throw new \LogicException('AskNotifierMapRepository is not set.');
        }

        return $this->AskNotifierMapRepository;
    }

    protected function hasAskNotifierMapRepository() : bool
    {
        return isset($this->AskNotifierMapRepository);
    }

    protected function unsetAskNotifierMapRepository() : self
    {
        if (!$this->hasAskNotifierMapRepository()) {
            throw new \LogicException('AskNotifierMapRepository is not set.');
        }
        unset($this->AskNotifierMapRepository);

        return $this;
    }


}

