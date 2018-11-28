<?php

namespace Neighborhoods\Kojo\Notifier\Repository;

/**
 * @codeCoverageIgnore
 */
trait AwareTrait
{

    protected $AskNotifierRepository = null;

    public function setAskNotifierRepository(\Neighborhoods\Kojo\Notifier\RepositoryInterface $AskNotifierRepository) : self
    {
        if ($this->hasAskNotifierRepository()) {
            throw new \LogicException('AskNotifierRepository is already set.');
        }
        $this->AskNotifierRepository = $AskNotifierRepository;

        return $this;
    }

    protected function getAskNotifierRepository() : \Neighborhoods\Kojo\Notifier\RepositoryInterface
    {
        if (!$this->hasAskNotifierRepository()) {
            throw new \LogicException('AskNotifierRepository is not set.');
        }

        return $this->AskNotifierRepository;
    }

    protected function hasAskNotifierRepository() : bool
    {
        return isset($this->AskNotifierRepository);
    }

    protected function unsetAskNotifierRepository() : self
    {
        if (!$this->hasAskNotifierRepository()) {
            throw new \LogicException('AskNotifierRepository is not set.');
        }
        unset($this->AskNotifierRepository);

        return $this;
    }


}

