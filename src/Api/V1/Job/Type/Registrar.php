<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type;

use Neighborhoods\Kojo\Type;
use Neighborhoods\Pylon\Data\Property;

class Registrar implements RegistrarInterface
{
    use Property\Defensive\AwareTrait;
    use Type\Service\Create\AwareTrait;

    public function save(): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->save();

        return $this;
    }

    public function setCode(string $code): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setCode($code);

        return $this;
    }

    public function setWorkerClassUri(string $workerModelUri): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setWorkerClassUri($workerModelUri);

        return $this;
    }

    public function setWorkerMethod(string $workerMethod): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setWorkerMethod($workerMethod);

        return $this;
    }

    public function setName(string $name): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setName($name);

        return $this;
    }

    public function setCronExpression(string $cronExpression): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setCronExpression($cronExpression);

        return $this;
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setCanWorkInParallel($canWorkInParallel);

        return $this;
    }

    public function setDefaultImportance(int $defaultImportance): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setDefaultImportance($defaultImportance);

        return $this;
    }

    public function setScheduleLimit(int $scheduleLimit): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setScheduleLimit($scheduleLimit);

        return $this;
    }

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setScheduleLimitAllowance($scheduleLimitAllowance);

        return $this;
    }

    public function setIsEnabled(bool $isEnabled): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setIsEnabled($isEnabled);

        return $this;
    }

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setAutoCompleteSuccess($autoCompleteSuccess);

        return $this;
    }

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): RegistrarInterface
    {
        $this->_getTypeServiceCreate()->setAutoDeleteIntervalDuration($autoDeleteIntervalDuration);

        return $this;
    }
}