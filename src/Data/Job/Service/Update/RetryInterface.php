<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface RetryInterface extends ServiceInterface
{
    public function setDateTime(\DateTime $dateTime): RetryInterface;
}