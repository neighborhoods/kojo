<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message;
use Neighborhoods\Kojo\Data;

class FromArrayBuilder implements FromArrayBuilderInterface
{
    use Message\SerializableProcess\FromArrayBuilder\Factory\AwareTrait;
    use Data\Job\FromArrayBuilder\Factory\AwareTrait;
    use Message\Metadata\Host\FromArrayBuilder\Factory\AwareTrait;
    use Factory\AwareTrait;

    /** @var array */
    protected $record;

    public function build() : Message\MetadataInterface
    {
        $metadata = $this->getProcessPoolLoggerMessageMetadataFactory()->create();
        $record = $this->getRecord();

        $serializableProcess = $this
            ->getProcessPoolLoggerMessageSerializableProcessFromArrayBuilderFactory()
            ->create()
            ->setRecord($record['process'])
            ->build();
        $metadata->setProcess($serializableProcess);

        $job = $this
            ->getDataJobFromArrayBuilderFactory()
            ->create()
            ->setRecord($record['job'])
            ->build();
        $metadata->setJob($job);

        $host = $this
            ->getProcessPoolLoggerMessageMetadataHostFromArrayBuilderFactory()
            ->create()
            ->setRecord($record['host'])
            ->build();
        $metadata->setHost($host);

        return $metadata;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('FromArrayBuilder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : FromArrayBuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('FromArrayBuilder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}
