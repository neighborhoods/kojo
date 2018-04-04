<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Job;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Service\CreateInterface;
use Neighborhoods\Kojo\Service\Update;
use Neighborhoods\Kojo\Api;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Service implements ServiceInterface
{
    use Job\AwareTrait;
    use Update\Hold\Factory\AwareTrait;
    use Update\Retry\Factory\AwareTrait;
    use Update\Complete\Success\Factory\AwareTrait;
    use Update\Complete\Failed\Factory\AwareTrait;
    use Api\V1\Service\Create\Factory\AwareTrait;
    use Defensive\AwareTrait;
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
        if (!$this->_exists(self::PROP_REQUEST_APPPLIED)) {
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

    public function getNewJobServiceCreate(): CreateInterface
    {
        return $this->_getServiceCreateFactory()->create();
    }
}