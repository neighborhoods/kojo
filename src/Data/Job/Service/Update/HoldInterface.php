<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface HoldInterface extends ServiceInterface
{
    public function save(): HoldInterface;
}