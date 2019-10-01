<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;

class FromArrayBuilder implements FromArrayBuilderInterface
{
    use Factory\AwareTrait;

    /** @var array */
    protected $record;

    public function build() : SerializableProcessInterface
    {
        $serializableProcess = $this->getProcessPoolLoggerMessageSerializableProcessFactory()->create();
        $record = $this->getRecord();

        $serializableProcess->setProcessId($record['process_id']);
        $serializableProcess->setParentProcessId($record['parent_process_id']);
        $serializableProcess->setPath($record['path']);
        $serializableProcess->setUuid($record['uuid']);
        $serializableProcess->setTypeCode($record['type_code']);
        $serializableProcess->setMemoryUsageBytes($record['memory_usage_bytes']);
        $serializableProcess->setMemoryPeakUsageBytes($record['memory_peak_usage_bytes']);
        $serializableProcess->setMemoryLimitBytes($record['memory_limit_bytes']);

        return $serializableProcess;
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
