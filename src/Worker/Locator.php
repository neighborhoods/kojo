<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Kojo\Worker\Locator\Exception;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Locator implements LocatorInterface
{
    use Job\AwareTrait;
    use Defensive\AwareTrait;
    protected $_callable = [];

    public function getClass()
    {
        return $this->getCallable()[0];
    }

    public function getCallable(): callable
    {
        if (empty($this->_callable)) {
            try {
                $className = $this->getClassName();
                $methodName = $this->getMethodName();
                $object = new $className;
                $callable = [$object, $methodName];
                if (is_callable($callable)) {
                    $this->_callable = $callable;
                } else {
                    throw new \RuntimeException("Class[$className] and method[$methodName] is not callable.");
                }
            } catch (\Throwable $throwable) {
                throw new \Exception($throwable->getMessage(), Exception::CODE_CANNOT_INSTANTIATE_WORKER, $throwable);
            }
        }

        return $this->_callable;
    }

    public function getMethodName(): string
    {
        return $this->_getJob()->getWorkerUri();
    }

    public function getClassName(): string
    {
        return $this->_getJob()->getWorkerMethod();
    }
}