<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\JobStateChangeInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use Data\Builder\Factory\AwareTrait;

    /** @var array */
    protected $record;

    public function build() : JobStateChangeInterface
    {
        $JobStateChange = $this->getJobStateChangeFactory()->create();
        $record = $this->getRecord();

        $JobStateChange->setId((int)$record[JobStateChangeInterface::PROP_ID]);
        $JobStateChange->setData(
            $this
                ->getJobStateChangeDataBuilderFactory()
                ->create()
                ->setRecord($record[JobStateChangeInterface::PROP_DATA])
                ->build()
        );

        return $JobStateChange;
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
