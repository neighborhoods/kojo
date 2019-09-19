<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map;

use Neighborhoods\Kojo\StateTransitionChange;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use StateTransitionChange\Builder\Factory\AwareTrait;
    /** @var array */
    protected $records;

    public function build() : StateTransitionChange\MapInterface
    {
        $map = $this->getStateTransitionChangeMapFactory()->create();

        foreach ($this->getRecords() as $record) {
            $builder = $this->getStateTransitionChangeBuilderFactory()->create();
            $item = $builder->setRecord($record)->build();
            $map[$item->getId()] = $item;
        }

        return $map;
    }

    protected function getRecords() : array
    {
        if ($this->records === null) {
            throw new \LogicException('Builder records has not been set.');
        }

        return $this->records;
    }

    public function setRecords(array $records) : BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }
}
