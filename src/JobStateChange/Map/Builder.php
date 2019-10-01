<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map;

use Neighborhoods\Kojo\JobStateChange;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use JobStateChange\Builder\Factory\AwareTrait;
    /** @var array */
    protected $records;

    public function build() : JobStateChange\MapInterface
    {
        $map = $this->getJobStateChangeMapFactory()->create();

        foreach ($this->getRecords() as $record) {
            $builder = $this->getJobStateChangeBuilderFactory()->create();
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
