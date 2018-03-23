<?php
declare(strict_types=1);

namespace NHDS\Jobs\Api\Worker\Job;

use NHDS\Jobs\Data\JobInterface;

interface ServiceInterface
{
    /** @injected:runtime */
    public function setJob(JobInterface $job): ServiceInterface;

    public function requestCompleteSuccess(): ServiceInterface;

    public function requestCompleteFailed(): ServiceInterface;

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface;

    public function requestHold(): ServiceInterface;

    public function save(): ServiceInterface;

    public function reload(): ServiceInterface;

    public function getTimesWorked(): int;

    public function getTimesRetried(): int;

    public function getTimesHeld(): int;

    public function getTimesCrashed(): int;

    public function getTimesPanicked(): int;
}