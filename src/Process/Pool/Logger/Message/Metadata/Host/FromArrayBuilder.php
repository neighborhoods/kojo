<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

class FromArrayBuilder implements FromArrayBuilderInterface
{
    /** @var array */
    protected $record;

    public function build() : Metadata\HostInterface
    {
        $host = new Metadata\Host();
        $record = $this->getRecord();

        $host->setHostName($record['host_name']);
        $host->setLoadAverage($record['load_average']);

        return $host;
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
