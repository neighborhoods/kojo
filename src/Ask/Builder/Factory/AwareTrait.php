<?php

namespace Neighborhoods\Kojo\Ask\Builder\Factory;

use Neighborhoods\Kojo\Ask\Builder\FactoryInterface;

trait AwareTrait
{
    protected $AskBuilderFactory;

    public function setAskBuilderFactory(FactoryInterface $AskBuilderFactory): self
    {
        if ($this->hasAskBuilderFactory()) {
            throw new \LogicException('AskBuilderFactory is already set.');
        }
        $this->AskBuilderFactory = $AskBuilderFactory;

        return $this;
    }

    protected function getAskBuilderFactory(): FactoryInterface
    {
        if (!$this->hasAskBuilderFactory()) {
            throw new \LogicException('AskBuilderFactory is not set.');
        }

        return $this->AskBuilderFactory;
    }

    protected function hasAskBuilderFactory(): bool
    {
        return isset($this->AskBuilderFactory);
    }

    protected function unsetAskBuilderFactory(): self
    {
        if (!$this->hasAskBuilderFactory()) {
            throw new \LogicException('AskBuilderFactory is not set.');
        }
        unset($this->AskBuilderFactory);

        return $this;
    }
}
