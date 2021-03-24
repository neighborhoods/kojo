<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Pylon\Time;
use Cron\CronExpression;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Api;
use Neighborhoods\Kojo\Process\Pool\Logger;

class Scheduler implements SchedulerInterface
{
    use Scheduler\Cache\AwareTrait;
    use Job\Collection\Scheduler\AwareTrait;
    use Job\Type\Collection\Scheduler\AwareTrait;
    use Time\AwareTrait;
    use Defensive\AwareTrait;
    use Service\Create\Factory\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Logger\AwareTrait;

    /** @var string */
    private $disabledJobTypeLogLevel;

    public function scheduleStaticJobs(): SchedulerInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->testAndSetLock()) {
            try {
                if (!empty($this->_getSchedulerCache()->getMinutesNotInCache())) {
                    $this->_scheduleStaticJobs();
                }
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->releaseLock();
            } catch (\Throwable $throwable) {
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_SCHEDULE)->releaseLock();
                }
                throw $throwable;
            }
        }

        return $this;
    }

    protected function _scheduleStaticJobs(): SchedulerInterface
    {
        $schedulerCache = $this->_getSchedulerCache();
        $this->_getSchedulerJobCollection()->setReferenceDateTime($this->_getTime()->getNow());
        foreach ($this->_getSchedulerJobTypeCollection()->getIterator() as $jobType) {
            if (!$jobType->getIsEnabled()) {
                $this->logDisabledJobTypeSkippedEvent($jobType->getCode());
                continue;
            }
            $cronExpressionString = $jobType->getCronExpression();
            $typeCode = $jobType->getCode();
            $cronExpression = CronExpression::factory($cronExpressionString);
            foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
                if ($cronExpression->isDue($unscheduledDateTime, 'UTC')) {
                    if (!isset($this->_getSchedulerJobCollection()->getRecords()[$typeCode][$unscheduledMinute])) {
                        $create = $this->_getServiceCreateFactory()->create();
                        $create->setJobTypeCode($typeCode);
                        $create->setWorkAtDateTime($unscheduledDateTime);
                        $create->save();
                    }
                }
            }
        }

        foreach ($schedulerCache->getMinutesNotInCache() as $unscheduledMinute => $unscheduledDateTime) {
            $this->_getSchedulerCache()->cacheScheduledMinutes($unscheduledDateTime);
        }

        return $this;
    }

    private function logDisabledJobTypeSkippedEvent(string $jobTypeCode) : SchedulerInterface
    {
        $logLevel = $this->getDisabledJobTypeLogLevel();

        if (!method_exists(\Psr\Log\LoggerInterface::class, $logLevel)) {
            throw new \UnexpectedValueException("Unexpected value for disabled job type log level [$logLevel]");
        }

        $this->_getLogger()->log(
            $logLevel,
            sprintf(
                'Scheduler skipping disabled job type [%s]',
                $jobTypeCode
            ),
            ['disabled_job_type_skipped' => $jobTypeCode]
        );

        return $this;
    }

    private function getDisabledJobTypeLogLevel() : string
    {
        if ($this->disabledJobTypeLogLevel === null) {
            throw new \LogicException('Scheduler disabledJobTypeLogLevel has not been set.');
        }
        return $this->disabledJobTypeLogLevel;
    }

    public function setDisabledJobTypeLogLevel(string $disabledJobTypeLogLevel) : SchedulerInterface
    {
        if ($this->disabledJobTypeLogLevel !== null) {
            throw new \LogicException('Scheduler disabledJobTypeLogLevel is already set.');
        }
        $this->disabledJobTypeLogLevel = $disabledJobTypeLogLevel;
        return $this;
    }
}
