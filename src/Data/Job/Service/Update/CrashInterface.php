<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface CrashInterface extends ServiceInterface
{
    public function save(): CrashInterface;
}