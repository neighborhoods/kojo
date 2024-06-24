<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\State;

use Neighborhoods\Kojo\Data\JobInterface;

interface ServiceInterface
{
    const STATE_NONE                                 = 'none';
    const STATE_NEW                                  = 'new';
    const STATE_SCHEDULE_LIMIT_CHECK                 = 'schedule_limit_check';
    const STATE_WORKING                              = 'working';
    const STATE_WAITING                              = 'waiting';
    const STATE_HOLD                                 = 'hold';
    const STATE_PANICKED                             = 'panicked';
    const STATE_CRASHED                              = 'crashed';
    const STATE_ENVIRONMENT_TERMINATED               = 'environment_terminated';
    const STATE_COMPLETE_SUCCESS                     = 'complete_success';
    const STATE_COMPLETE_TERMINATED                  = 'complete_terminated';
    const STATE_COMPLETE_FAILED                      = 'complete_failed';
    const STATE_COMPLETE_FAILED_SCHEDULE_LIMIT_CHECK = 'complete_failed_schedule_limit_check';

    public function setJob(JobInterface $job);

    public function requestScheduleLimitCheck(): ServiceInterface;

    public function requestCompleteFailedScheduleLimitCheck(): ServiceInterface;

    public function requestWaitForWork(): ServiceInterface;

    public function requestCompleteSuccess(): ServiceInterface;

    public function requestCompleteTerminated(): ServiceInterface;

    public function requestCompleteFailed(): ServiceInterface;

    public function requestCrashed(): ServiceInterface;

    public function requestEnvironmentTerminated(): ServiceInterface;

    public function requestPanicked(): ServiceInterface;

    public function requestHold(): ServiceInterface;

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface;

    public function applyRequest(): ServiceInterface;

    public function requestNew(): ServiceInterface;

    public function requestWork(): ServiceInterface;

    public function isValidTransition(): bool;
}
