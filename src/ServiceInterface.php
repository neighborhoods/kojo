<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data\JobInterface;

interface ServiceInterface
{
    public function setStateService(State\ServiceInterface $jobStateService);

    public function setJob(JobInterface $job);

    public function save(): ServiceInterface;
}