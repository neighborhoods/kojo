<?php

namespace NHDS\Jobs\Data\Job\Service;

interface CreateInterface
{
    public function setJobTypeCode(string $jobTypeCode): CreateInterface;

    public function setImportance(int $importance): CreateInterface;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface;

    public function save(): CreateInterface;
}