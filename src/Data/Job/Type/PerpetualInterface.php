<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Db\ModelInterface;

interface PerpetualInterface extends ModelInterface
{
    const TABLE_NAME               = 'nhds_job_type_perpetual';
    const FIELD_NAME_ID            = 'nhds_job_type_perpetual_id';
    const FILED_NAME_TYPE_CODE     = 'type_code';
    const FIELD_NAME_WORKER_URI    = 'worker_uri';
    const FIELD_NAME_WORKER_METHOD = 'worker_method';

    public function setTypeCode(string $typeCode): PerpetualInterface;

    public function getTypeCode(): string;

    public function setWorkerUri(string $autoSchedulerUri): PerpetualInterface;

    public function getWorkerUri(): string;

    public function setWorkerMethod(string $autoSchedulerMethod): PerpetualInterface;

    public function getWorkerMethod(): string;
}