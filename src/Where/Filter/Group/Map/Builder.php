<?php

namespace Neighborhoods\Kojo\Where\Filter\Group\Map;

use Neighborhoods\Kojo\Where;
use Neighborhoods\Kojo\Where\Filter\Group\MapInterface;

class Builder implements BuilderInterface
{
    use Where\Filter\Group\Map\Factory\AwareTrait;
    use Where\Filter\Group\Builder\Factory\AwareTrait;

    protected $records = null;

    public function build(): MapInterface
    {
        // TODO: Implement build() method.
        throw new \LogicException('Unimplemented build method.');

        $map = $this->getWhereFilterGroupMapFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getWhereFilterGroupBuilderFactory()->create();
            $item = $builder->setRecord($record)->build();
            $map[$item->getId()] = $item; // remove or change index field as desired
        }

        return $map;
    }

    protected function getRecords(): array
    {
        if ($this->records === null) {
            throw new \LogicException('Builder records has not been set.');
        }

        return $this->records;
    }

    public function setRecords(array $records): BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }
}
