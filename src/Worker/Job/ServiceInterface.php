<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Job;

use Neighborhoods\Kojo\Api\V1\Service\Create\FactoryInterface;
use Neighborhoods\Kojo\Service\CreateInterface;
use Neighborhoods\Kojo\Service\Update\Hold;
use Neighborhoods\Kojo\Service\Update\Retry;
use Neighborhoods\Kojo\Service\Update\Complete\Success;
use Neighborhoods\Kojo\Service\Update\Complete\Failed;

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