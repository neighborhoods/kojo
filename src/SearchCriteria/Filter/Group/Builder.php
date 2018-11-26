<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group;

class Builder implements BuilderInterface
{

    use \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $record = null;

    public function build() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface
    {
        $Group =
            $this->getSearchCriteriaFilterGroupFactory()
                ->create();
        return $Group->setAddFilter($this->record['filter'])
->setFilters($this->record['filters'])
;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : \Neighborhoods\Kojo\SearchCriteria\Filter\Group\BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }


}

