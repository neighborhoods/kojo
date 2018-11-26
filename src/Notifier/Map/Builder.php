<?php

namespace Neighborhoods\Kojo\Notifier\Map;

class Builder implements BuilderInterface
{

    use \Neighborhoods\Kojo\Notifier\Map\Factory\AwareTrait, \Neighborhoods\Kojo\Notifier\Builder\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $records = null;

    public function build() : \Neighborhoods\Kojo\Notifier\MapInterface
    {
        $map = $this->getRETS1NotifierMapFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getRETS1NotifierBuilderFactory()->create();
            $item = $builder->setRecord($record)->build();
            $map[$item->getId()] = $item; // remove or change index field as desired
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

    public function setRecords(array $records) : \Neighborhoods\Kojo\Notifier\Map\BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }


}

