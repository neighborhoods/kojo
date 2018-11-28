<?php

namespace Neighborhoods\Kojo\Ask\Builder;

use Neighborhoods\Kojo\Ask\BuilderInterface;

trait AwareTrait
{
    protected $AskBuilder;

    public function setAskBuilder(BuilderInterface $AskBuilder): self
    {
        if ($this->hasAskBuilder()) {
            throw new \LogicException('AskBuilder is already set.');
        }
        $this->AskBuilder = $AskBuilder;

        return $this;
    }

    protected function getAskBuilder(): BuilderInterface
    {
        if (!$this->hasAskBuilder()) {
            throw new \LogicException('AskBuilder is not set.');
        }

        return $this->AskBuilder;
    }

    protected function hasAskBuilder(): bool
    {
        return isset($this->AskBuilder);
    }

    protected function unsetAskBuilder(): self
    {
        if (!$this->hasAskBuilder()) {
            throw new \LogicException('AskBuilder is not set.');
        }
        unset($this->AskBuilder);

        return $this;
    }
}
