<?php

namespace NHDS\Jobs\Data\Job\State;

use NHDS\Jobs\Data\JobInterface;

interface ServiceInterface
{
    const STATE_NONE             = 'none';
    const STATE_NEW              = 'new';
    const STATE_WORKING          = 'working';
    const STATE_WAITING          = 'waiting';
    const STATE_HOLD             = 'hold';
    const STATE_PANICKED         = 'panicked';
    const STATE_CRASHED          = 'crashed';
    const STATE_COMPLETE_SUCCESS = 'complete_success';
    const STATE_COMPLETE_QUIT    = 'complete_quit';
    const STATE_COMPLETE_FAILED  = 'complete_failed';

    public function setJob(JobInterface $job);

    public function requestWork(): ServiceInterface;

    public function requestCompleteSuccess(): ServiceInterface;

    public function requestCompleteQuit(): ServiceInterface;

    public function requestCompleteFailed(): ServiceInterface;

    public function requestCrashed(): ServiceInterface;

    public function requestPanicked(): ServiceInterface;

    public function requestHold(): ServiceInterface;

    public function requestRetry(\DateTime $retryDateTime): ServiceInterface;

    public function applyRequest(): ServiceInterface;
}