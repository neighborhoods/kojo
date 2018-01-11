<?php

namespace NHDS\Jobs\Worker\Job;

use NHDS\Jobs\Data\Job;
use NHDS\Jobs\Data\Job\Service\Update\Hold;
use NHDS\Jobs\Data\Job\Service\Update\Retry;
use NHDS\Jobs\Data\Job\Service\Update\Complete\Success;
use NHDS\Jobs\Data\Job\Service\Update\Complete\Failed;
use NHDS\Jobs\Data\Job\Service\Create;

interface ServiceInterface
{
    public function requestRetry(\DateTime $retryDateTime): ServiceInterface;

    public function requestHold(): ServiceInterface;

    public function requestCompleteSuccess(): ServiceInterface;

    public function requestCompleteFailed(): ServiceInterface;

    public function applyRequest(): ServiceInterface;

    public function getNewJobServiceCreate(): Job\Service\CreateInterface;

    public function setUpdateHoldFactory(Hold\FactoryInterface $updateHoldFactory);

    public function setUpdateRetryFactory(Retry\FactoryInterface $updateRetryFactory);

    public function setUpdateCompleteSuccessFactory(Success\FactoryInterface $updateCompleteSuccessFactory);

    public function setUpdateCompleteFailedFactory(Failed\FactoryInterface $updateCompleteFailedFactory);

    public function setJobServiceCreateFactory(Create\FactoryInterface $updateCrashFactory);

    public function isRequestApplied(): bool;
}