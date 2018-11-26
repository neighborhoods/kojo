<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map;

class Builder implements BuilderInterface
{

    use \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Factory\AwareTrait, \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Builder\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $records = null;

    public function build() : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\MapInterface
    {
        $map = $this->getSearchCriteriaFilterGroupMapFactory()->create();
        foreach ($this->getRecords() as $record) {
            $builder = $this->getSearchCriteriaFilterGroupBuilderFactory()->create();
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

    public function setRecords(array $records) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }


}

