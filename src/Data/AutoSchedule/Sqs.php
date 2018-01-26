<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\AutoSchedule;

use NHDS\Jobs\Db\Model;
use NHDS\Toolkit\Data\Property\Strict;

class Sqs extends Model implements SqsInterface
{
    use Strict\AwareTrait;

    public function __construct()
    {
        $this->setTableName(SqsInterface::TABLE_NAME);
        $this->setIdPropertyName(SqsInterface::FIELD_NAME_ID);

        return $this;
    }

    public function setSqsQueueName(string $sqsQueueName): SqsInterface
    {
        $this->_create(self::FIELD_NAME_SQS_QUEUE_NAME, $sqsQueueName);

        return $this;
    }

    public function getSqsQueueName(): string
    {
        return $this->_read(self::FIELD_NAME_SQS_QUEUE_NAME);
    }

    public function setJobTypeCode(string $jobTypeCode): SqsInterface
    {
        $this->_create(self::FIELD_NAME_JOB_TYPE_CODE, $jobTypeCode);

        return $this;
    }

    public function getJobTypeCode(): string
    {
        return $this->_read(self::FIELD_NAME_JOB_TYPE_CODE);
    }
}