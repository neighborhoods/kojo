<?php

namespace Neighborhoods\Kojo\Where\Filter\Group;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Where\Filter\Group\Factory\AwareTrait;

    protected $record;

    public function build(): GroupInterface
    {
        // TODO: Implement build() method.
        throw new \LogicException('Unimplemented build method.');
        $group = $this->getWhereFilterGroupFactory()->create();

        return $group;
    }

    protected function getRecord(): array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record): BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}
