<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Cancelled;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface FailedLimitCheckInterface extends ServiceInterface
{
    public function save(): FailedLimitCheckInterface;
}