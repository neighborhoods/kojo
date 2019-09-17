<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    /** @var array */
    protected $record;

    public function build() : MetadataInterface
    {
        $metadata = $this->getProcessPoolLoggerMessageMetadataFactory()->create();
        $record = $this->getRecord();

        // Set fields from record
        // $metadata->setId($record[MetadataInterface::FIELD_ID]);
        // etc.

        return $metadata;
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
