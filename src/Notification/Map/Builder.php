<?php

namespace Neighborhoods\Kojo\Notification\Map;

class Builder implements BuilderInterface
{

    use \Neighborhoods\Kojo\Notification\Map\Factory\AwareTrait, \Neighborhoods\Kojo\Notification\Builder\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $records = null;

    public function build() : \Neighborhoods\Kojo\Notification\MapInterface
    {
        $map = $this->getAskNotificationMapFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getAskNotificationBuilderFactory()->create();
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

    public function setRecords(array $records) : \Neighborhoods\Kojo\Notification\Map\BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }


}

