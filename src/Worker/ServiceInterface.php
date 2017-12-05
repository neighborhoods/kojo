<?php

namespace NHDS\Jobs\Worker;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Status;

interface ServiceInterface
{
    public function setJobService(Job\ServiceInterface $jobService): ServiceInterface;

    public function setStatusService(Status\ServiceInterface $statusService): ServiceInterface;

    public function setJob(Job $job): ServiceInterface;

    public function getJobId(): int;

    public function getJobTypeCode(): string;

    public function didWorkerCrash(): bool;

    public function isWorkerRetrying(): bool;

    public function getTimesRetried(): int;

    public function retryJob(\DateTime $dateTime);

    public function holdJob(): ServiceInterface;

    public function quitJob(): ServiceInterface;

    public function jobSucceeded(): ServiceInterface;

    public function jobFailed(): ServiceInterface;

    public function addError(string $message, string $code = ''): ServiceInterface;

    public function addCritical(string $message, string $code = ''): ServiceInterface;

    public function addInformation(string $message, string $code = ''): ServiceInterface;

    public function save(): ServiceInterface;

    public function rollback(): ServiceInterface;
}