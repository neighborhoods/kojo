<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type;

interface RegistrarInterface
{
    public function save(): RegistrarInterface;

    public function setCode(string $code): RegistrarInterface;

    public function setWorkerClassUri(string $workerModelUri): RegistrarInterface;

    public function setWorkerMethod(string $workerMethod): RegistrarInterface;

    public function setName(string $name): RegistrarInterface;

    public function setCronExpression(string $cronExpression): RegistrarInterface;

    public function setCanWorkInParallel(bool $canWorkInParallel): RegistrarInterface;

    public function setDefaultImportance(int $defaultImportance): RegistrarInterface;

    public function setScheduleLimit(int $scheduleLimit): RegistrarInterface;

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): RegistrarInterface;

    public function setIsEnabled(bool $isEnabled): RegistrarInterface;

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): RegistrarInterface;

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): RegistrarInterface;
}