<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Worker;

use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;
use Neighborhoods\Kojo\Api\V1\LoggerInterface;
use Neighborhoods\Kojo\Data\JobInterface;
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

    public function isRequestApplied(): bool;

    public function getLogger(): LoggerInterface;

    public function getNewJobScheduler(): SchedulerInterface;

    public function reload(): ServiceInterface;

    public function getTimesCrashed(): int;

    /** @injected:configuration */
    public function setServiceUpdateRetryFactory(Retry\FactoryInterface $updateRetryFactory);

    /** @injected:configuration */
    public function setServiceUpdateCompleteSuccessFactory(Success\FactoryInterface $updateCompleteSuccessFactory);

    /** @injected:configuration */
    public function setServiceUpdateCompleteFailedFactory(Failed\FactoryInterface $updateCompleteFailedFactory);

    /** @injected:configuration */
    public function setServiceUpdateHoldFactory(Hold\FactoryInterface $updateHoldFactory);

    /** @injected:runtime */
    public function setJob(JobInterface $job);
}