<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Db\Model;
use NHDS\Toolkit\Data\Property\Strict;

class Perpetual extends Model implements PerpetualInterface
{
    use Strict\AwareTrait;

    public function setTypeCode(string $typeCode): PerpetualInterface
    {
        $this->_create(self::FILED_NAME_TYPE_CODE, $typeCode);

        return $this;
    }

    public function getTypeCode(): string
    {
        return $this->_read(self::FILED_NAME_TYPE_CODE);
    }

    public function setWorkerUri(string $autoSchedulerUri): PerpetualInterface
    {
        $this->_create(self::FIELD_NAME_WORKER_URI, $autoSchedulerUri);

        return $this;
    }

    public function getWorkerUri(): string
    {
        return $this->_read(self::FIELD_NAME_WORKER_URI);
    }

    public function setWorkerMethod(string $autoSchedulerMethod): PerpetualInterface
    {
        $this->_create(self::FIELD_NAME_WORKER_METHOD, $autoSchedulerMethod);

        return $this;
    }

    public function getWorkerMethod(): string
    {
        return $this->_read(self::FIELD_NAME_WORKER_METHOD);
    }
}