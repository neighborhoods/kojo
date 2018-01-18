<?php
declare(strict_types=1);

namespace NHDS\Jobs\Worker\Job;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Strict;

class Service implements ServiceInterface
{
    use Job\AwareTrait;
    use Job\Service\Update\Hold\Factory\AwareTrait;
    use Job\Service\Update\Retry\Factory\AwareTrait;
    use Job\Service\Update\Complete\Success\Factory\AwareTrait;
    use Job\Service\Update\Complete\Failed\Factory\AwareTrait;
    use Job\Service\Create\Factory\AwareTrait;
    use Strict\AwareTrait;
    const PROP_REQUEST             = 'request';
    const PROP_RETRY_DATE_TIME     = 'retry_date_time';
    const REQUEST_RETRY            = 'retry';
    const REQUEST_HOLD             = 'hold';
    const REQUEST_COMPLETE_SUCCESS = 'complete_success';
    const REQUEST_COMPLETE_FAILED  = 'complete_failed';
    const PROP_REQUEST_APPPLIED    = 'request_applied';

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface
    {
        $this->_createOrUpdate(self::PROP_REQUEST, self::REQUEST_RETRY);

        return $this;
    }

    protected function _updateOrInsertDateTime(\DateTime $dateTime): Service
    {
        $this->_createOrUpdate(self::PROP_RETRY_DATE_TIME, $dateTime);
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
        if (!$this->_exists(self::PROP_REQUEST_APPPLIED)) {
            switch ($this->_read(self::PROP_REQUEST)) {
                case self::REQUEST_RETRY:
                    $updateRetry = $this->_getUpdateRetryFactory()->create();
                    $updateRetry->setDateTime($this->_getDateTime());
                    $updateRetry->setJob($this->_getJob());
                    $updateRetry->save();
                    break;
                case self::REQUEST_HOLD:
                    $updateHold = $this->_getUpdateHoldFactory()->create();
                    $updateHold->setJob($this->_getJob());
                    $updateHold->save();
                    break;
                case self::REQUEST_COMPLETE_SUCCESS:
                    $updateCompleteSuccess = $this->_getUpdateCompleteSuccessFactory()->create();
                    $updateCompleteSuccess->setJob($this->_getJob());
                    $updateCompleteSuccess->save();
                    break;
                case self::REQUEST_COMPLETE_FAILED:
                    $updateCompleteFailed = $this->_getUpdateCompleteFailedFactory()->create();
                    $updateCompleteFailed->setJob($this->_getJob());
                    $updateCompleteFailed->save();
                    break;
                default:
                    throw new \UnexpectedValueException('Unexpected value "' . $this->_read(self::PROP_REQUEST) . '"');
            }
            $this->_create(self::PROP_REQUEST_APPPLIED, true);
        }

        return $this;
    }

    public function isRequestApplied(): bool
    {
        return $this->_exists(self::PROP_REQUEST_APPPLIED);
    }

    public function getNewJobServiceCreate(): Job\Service\CreateInterface
    {
        return $this->_getJobServiceCreateFactory()->create();
    }
}