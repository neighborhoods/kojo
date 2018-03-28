<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\AutoSchedule;

use Neighborhoods\Kojo\Db\ModelInterface;

interface SqsInterface extends ModelInterface
{
    const TABLE_NAME                = 'kojo_job_auto_schedule_sqs';
    const FIELD_NAME_ID             = 'kojo_job_auto_schedule_sqs_id';
    const FIELD_NAME_SQS_QUEUE_NAME = 'sqs_queue_name';
    const FIELD_NAME_JOB_TYPE_CODE  = 'job_type_code';
    const INDEX_NAME_COVERING       = 'COVERING';


    public function setJobTypeCode(string $jobTypeCode): SqsInterface;

    public function getJobTypeCode(): string;

    public function setSqsQueueName(string $sqsQueueName): SqsInterface;

    public function getSqsQueueName(): string;
}