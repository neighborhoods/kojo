<?php

namespace NHDS\Jobs\Data\Job\Service\Update\Complete;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface SuccessInterface extends ServiceInterface
{
    public function save(): SuccessInterface;
}