<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service;

use Neighborhoods\Kojo\Type;

interface CreateInterface extends Type\ServiceInterface
{
    public function setCode(string $code): CreateInterface;

    public function setWorkerClassUri(string $workerModelUri): CreateInterface;

    public function setWorkerMethod(string $workerMethod): CreateInterface;

    public function setName(string $name): CreateInterface;

    public function setCronExpression(string $cronExpression): CreateInterface;

    public function setCanWorkInParallel(bool $canWorkInParallel): CreateInterface;

    public function setDefaultImportance(int $defaultImportance): CreateInterface;

    public function setScheduleLimit(int $scheduleLimit): CreateInterface;

    public function setIsEnabled(bool $isEnabled): CreateInterface;

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): CreateInterface;

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): CreateInterface;

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): CreateInterface;
}