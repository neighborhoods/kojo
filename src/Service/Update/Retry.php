<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

use Neighborhoods\Kojo\ServiceAbstract;

class Retry extends ServiceAbstract implements RetryInterface
{
    const PROP_DATE_TIME = 'date_time';

    public function _save(): RetryInterface
    {
        $this->_getStateService()->setJob($this->_getJob());
        $this->_getStateService()->requestRetry($this->_getDateTime());
        $this->_getStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }

    public function setDateTime(\DateTime $dateTime): RetryInterface
    {
        $this->_create(self::PROP_DATE_TIME, $dateTime);

        return $this;
    }

    protected function _getDateTime(): \DateTime
    {
        return $this->_read(self::PROP_DATE_TIME);
    }
}