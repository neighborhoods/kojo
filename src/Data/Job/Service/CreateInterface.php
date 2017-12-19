<?php

namespace NHDS\Jobs\Data\Job\Service;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface CreateInterface extends ServiceInterface
{
    public function setJobTypeCode(string $jobTypeCode): CreateInterface;

    public function save(): CreateInterface;

    public function setImportance(int $importance): CreateInterface;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface;
}