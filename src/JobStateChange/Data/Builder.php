<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data;

use Neighborhoods\Kojo\JobStateChange\DataInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    /** @var array */
    protected $record;

    public function build() : DataInterface
    {
        $data = $this->getJobStateChangeDataFactory()->create();
        $record = $this->getRecord();

        $data->setOldState($record[DataInterface::PROP_OLD_STATE]);
        $data->setNewState($record[DataInterface::PROP_NEW_STATE]);
        $data->setTimestamp(new \DateTimeImmutable($record[DataInterface::PROP_TIMESTAMP]));

        return $data;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}
