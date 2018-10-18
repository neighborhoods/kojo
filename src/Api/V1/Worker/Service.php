<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Worker;

use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;
use Neighborhoods\Kojo\Api\V1\LoggerInterface;
use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Api;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Service\Create;

class Service implements ServiceInterface
{
    use Job\AwareTrait;
    use Api\V1\Logger\AwareTrait;
    use Api\V1\Job\Scheduler\Factory\AwareTrait;
    use Update\Hold\Factory\AwareTrait;
    use Update\Retry\Factory\AwareTrait;
    use Update\Complete\Success\Factory\AwareTrait;
    use Update\Complete\Failed\Factory\AwareTrait;
    use Create\Factory\AwareTrait;
    use Defensive\AwareTrait;
    protected const     PROP_REQUEST = 'request';
    protected const     PROP_RETRY_DATE_TIME = 'retry_date_time';
    protected const     REQUEST_RETRY = 'retry';
    protected const     REQUEST_HOLD = 'hold';
    protected const     REQUEST_COMPLETE_SUCCESS = 'complete_success';
    protected const     REQUEST_COMPLETE_FAILED = 'complete_failed';
    protected const     PROP_REQUEST_APPLIED = 'request_applied';

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface
    {
        $this->_createOrUpdate(self::PROP_REQUEST, self::REQUEST_RETRY);

        return $this;
    }

    protected function _updateOrInsertDateTime(\DateTime $dateTime): Service
    {
        $this->_createOrUpdate(self::PROP_RETRY_DATE_TIME, $dateTime);

        return $this;
    }

    protected function _getDateTime(): \DateTime
    {
        return $this->_read(self::PROP_RETRY_DATE_TIME);
    }

    public function requestHold(): ServiceInterface
    {
        $this->_createOrUpdate(self::PROP_REQUEST, self::REQUEST_HOLD);

        return $this;
    }

    public function requestCompleteSuccess(): ServiceInterface
    {
        $this->_createOrUpdate(self::PROP_REQUEST, self::REQUEST_COMPLETE_SUCCESS);

        return $this;
    }

    public function requestCompleteFailed(): ServiceInterface
    {
        $this->_createOrUpdate(self::PROP_REQUEST, self::REQUEST_COMPLETE_FAILED);

        return $this;
    }

    public function applyRequest(): ServiceInterface
    {
        if (!$this->_exists(self::PROP_REQUEST_APPLIED)) {
            switch ($this->_read(self::PROP_REQUEST)) {
                case self::REQUEST_RETRY:
                    $updateRetry = $this->_getServiceUpdateRetryFactory()->create();
                    $updateRetry->setDateTime($this->_getDateTime());
                    $updateRetry->setJob($this->_getJob());
                    $updateRetry->save();
                    break;
                case self::REQUEST_HOLD:
                    $updateHold = $this->_getServiceUpdateHoldFactory()->create();
                    $updateHold->setJob($this->_getJob());
                    $updateHold->save();
                    break;
                case self::REQUEST_COMPLETE_SUCCESS:
                    $updateCompleteSuccess = $this->_getServiceUpdateCompleteSuccessFactory()->create();
                    $updateCompleteSuccess->setJob($this->_getJob());
                    $updateCompleteSuccess->save();
                    break;
                case self::REQUEST_COMPLETE_FAILED:
                    $updateCompleteFailed = $this->_getServiceUpdateCompleteFailedFactory()->create();
                    $updateCompleteFailed->setJob($this->_getJob());
                    $updateCompleteFailed->save();
                    break;
                default:
                    throw new \UnexpectedValueException('Unexpected value[' . $this->_read(self::PROP_REQUEST) . '].');
            }
            $this->_create(self::PROP_REQUEST_APPLIED, true);
        }

        return $this;
    }

    public function isRequestApplied(): bool
    {
        return $this->_exists(self::PROP_REQUEST_APPLIED);
    }

    public function getTimesCrashed(): int
    {
        return $this->_getJob()->getTimesCrashed();
    }

    public function getLogger(): LoggerInterface
    {
        return $this->getApiV1Logger();
    }

    public function reload(): ServiceInterface
    {
        return $this;
    }

    public function getNewJobScheduler(): SchedulerInterface
    {
        return $this->getApiV1JobSchedulerFactory()->create();
    }

    public function getJobId(): int
    {
        return $this->_getJob()->getId();
    }

    public function getTimesRetried() : int
    {
        return $this->_getJob()->getTimesRetried();
    }
}
