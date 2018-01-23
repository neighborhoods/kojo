<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Db\ModelInterface;

interface PerpetualInterface extends ModelInterface
{
    const TABLE_NAME               = 'nhds_job_type_perpetual';
    const FIELD_NAME_ID            = 'nhds_job_type_perpetual_id';
    const FIELD_NAME_TYPE_CODE     = 'type_code';
    const FIELD_NAME_NAME          = 'name';
    const FIELD_NAME_WORKER_URI    = 'worker_uri';
    const FIELD_NAME_WORKER_METHOD = 'worker_method';
    const FIELD_NAME_IS_ENABLED    = 'is_enabled';
    const INDEX_NAME_COVERING      = 'TYPE_PERPETUAL_COVERING';

    public function setTypeCode(string $typeCode): PerpetualInterface;

    public function getTypeCode(): string;

    public function setName(string $name): PerpetualInterface;

    public function getName(): string;

    public function setWorkerUri(string $autoSchedulerUri): PerpetualInterface;

    public function getWorkerUri(): string;

    public function setWorkerMethod(string $autoSchedulerMethod): PerpetualInterface;

    public function getWorkerMethod(): string;

    public function setIsEnabled(bool $isEnabled): PerpetualInterface;

    public function getIsEnabled(): bool;
}