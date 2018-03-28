<?php
declare(strict_types=1);

namespace NHDS\Jobs\Worker\Job;

use NHDS\Jobs\Api\V1\Service\Create\FactoryInterface;
use NHDS\Jobs\Service\CreateInterface;
use NHDS\Jobs\Service\Update\Hold;
use NHDS\Jobs\Service\Update\Retry;
use NHDS\Jobs\Service\Update\Complete\Success;
use NHDS\Jobs\Service\Update\Complete\Failed;

interface ServiceInterface
{
    public function requestRetry(\DateTime $retryDateTime): ServiceInterface;

    public function requestHold(): ServiceInterface;

    public function requestCompleteSuccess(): ServiceInterface;

    public function requestCompleteFailed(): ServiceInterface;

    public function applyRequest(): ServiceInterface;

    public function getNewJobServiceCreate(): CreateInterface;

    public function setServiceUpdateHoldFactory(Hold\FactoryInterface $updateHoldFactory);

    public function setServiceUpdateRetryFactory(Retry\FactoryInterface $updateRetryFactory);

    public function setServiceUpdateCompleteSuccessFactory(Success\FactoryInterface $updateCompleteSuccessFactory);

    public function setServiceUpdateCompleteFailedFactory(Failed\FactoryInterface $updateCompleteFailedFactory);

    public function setServiceCreateFactory(FactoryInterface $updateCrashFactory);

    public function isRequestApplied(): bool;
}