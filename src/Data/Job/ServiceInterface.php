<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;

interface ServiceInterface
{
    const STATE_EMPTY            = 'empty';
    const STATE_NEW              = 'new';
    const STATE_WORKING          = 'working';
    const STATE_WAIT             = 'wait';
    const STATE_WAIT_RETRY       = 'wait_retry';
    const STATE_HOLD             = 'hold';
    const STATE_PANICKED         = 'panicked';
    const STATE_CRASHED          = 'crashed';
    const STATE_COMPLETE_SUCCESS = 'complete_success';
    const STATE_COMPLETE_QUIT    = 'complete_quit';
    const STATE_COMPLETE_FAILED  = 'complete_failed';

    public function setJob(JobInterface $job): ServiceInterface;

    public function requestWork(): ServiceInterface;

    public function requestCompleteSuccess(): ServiceInterface;

    public function requestCompleteQuit(): ServiceInterface;

    public function requestCompleteFailed(): ServiceInterface;

    public function requestCrashed(): ServiceInterface;

    public function requestPanicked(): ServiceInterface;

    public function requestHold(): ServiceInterface;

    public function requestRetry(\DateTime $dateTime): ServiceInterface;

    public function applyRequestedState(): ServiceInterface;
}