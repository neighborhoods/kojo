<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\AutoSchedule;

use Neighborhoods\Kojo\Db\Model;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Sqs extends Model implements SqsInterface
{
    use Defensive\AwareTrait;

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