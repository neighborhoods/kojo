<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job;

use Neighborhoods\Kojo\Service;

class Scheduler implements SchedulerInterface
{
    use Service\Create\AwareTrait;

    public function setJobTypeCode(string $jobTypeCode): SchedulerInterface
    {
        $this->_getServiceCreate()->setJobTypeCode($jobTypeCode);

        return $this;
    }

    public function setImportance(int $importance): SchedulerInterface
    {
        $this->_getServiceCreate()->setImportance($importance);

        return $this;
    }

    public function setWorkAtDateTime(\DateTime $workAtDateTime): SchedulerInterface
    {
        $this->_getServiceCreate()->setWorkAtDateTime($workAtDateTime);

        return $this;
    }

    public function getJobId(): int
    {
        return $this->_getServiceCreate()->getJobId();
    }

    public function save(): SchedulerInterface
    {
        $this->_getServiceCreate()->save();

        return $this;
    }
}
