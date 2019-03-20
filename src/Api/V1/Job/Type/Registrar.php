<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type;

use Neighborhoods\Kojo\Type;
use Neighborhoods\Pylon\Data\Property;

class Registrar implements RegistrarInterface
{
    use Property\Defensive\AwareTrait;
    use Type\Service\Create\AwareTrait;

    /** @var Type\Service\CreateInterface */
    protected $typeServiceCreate;

    public function save(): RegistrarInterface
    {
        $this->getTypeServiceCreate()->save();

        return $this;
    }

    public function setCode(string $code): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setCode($code);

        return $this;
    }

    public function setWorkerClassUri(string $workerModelUri): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setWorkerClassUri($workerModelUri);

        return $this;
    }

    public function setWorkerMethod(string $workerMethod): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setWorkerMethod($workerMethod);

        return $this;
    }

    public function setName(string $name): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setName($name);

        return $this;
    }

    public function setCronExpression(string $cronExpression): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setCronExpression($cronExpression);

        return $this;
    }

    public function setCanWorkInParallel(bool $canWorkInParallel): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setCanWorkInParallel($canWorkInParallel);

        return $this;
    }

    public function setDefaultImportance(int $defaultImportance): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setDefaultImportance($defaultImportance);

        return $this;
    }

    public function setScheduleLimit(int $scheduleLimit): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setScheduleLimit($scheduleLimit);

        return $this;
    }

    public function setScheduleLimitAllowance(int $scheduleLimitAllowance): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setScheduleLimitAllowance($scheduleLimitAllowance);

        return $this;
    }

    public function setIsEnabled(bool $isEnabled): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setIsEnabled($isEnabled);

        return $this;
    }

    public function setAutoCompleteSuccess(bool $autoCompleteSuccess): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setAutoCompleteSuccess($autoCompleteSuccess);

        return $this;
    }

    public function setAutoDeleteIntervalDuration(string $autoDeleteIntervalDuration): RegistrarInterface
    {
        $this->getTypeServiceCreate()->setAutoDeleteIntervalDuration($autoDeleteIntervalDuration);

        return $this;
    }

    protected function getTypeServiceCreate() : Type\Service\CreateInterface
    {
        if ($this->typeServiceCreate === null) {
            $this->typeServiceCreate = $this->_getTypeServiceCreateClone();
        }
        return $this->typeServiceCreate;
    }
}
