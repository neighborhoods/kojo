<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\AbstractService;

class Retry extends AbstractService implements RetryInterface
{
    const PROP_DATE_TIME = 'date_time';

    public function save(): RetryInterface
    {
        $this->_getJobStateService()->setJob($this->_getJob());
        $this->_getJobStateService()->requestRetry($this->_getDateTime());
        $this->_getJobStateService()->applyRequest();
        $this->_getJob()->save();

        return $this;
    }

    public function setDateTime(\DateTime $dateTime): RetryInterface
    {
        $this->_create(self::PROP_DATE_TIME, $dateTime);
    }

    protected function _getDateTime(): \DateTime
    {
        return $this->_read(self::PROP_DATE_TIME);
    }
}