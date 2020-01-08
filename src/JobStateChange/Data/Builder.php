<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data;

use Neighborhoods\Kojo\JobStateChange\DataInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

class Builder implements BuilderInterface
{
    use Metadata\FromArrayBuilder\Factory\AwareTrait;
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

        $metadata = $this
            ->getProcessPoolLoggerMessageMetadataFromArrayBuilderFactory()
            ->create()
            ->setRecord($record[DataInterface::PROP_METADATA])
            ->build();

        $data->setMetadata($metadata);

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
