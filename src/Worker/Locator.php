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
    protected const PROP_METHOD_NAME = 'method_name';
    protected const PROP_CLASS_NAME  = 'class_name';
    protected $_callable = [];

    public function getClass()
    {
        return $this->getCallable()[0];
    }

    public function getCallable(): callable
    {
        if (empty($this->_callable)) {
            try{
                $class = $this->_getJob()->getWorkerUri();
                $method = $this->_getJob()->getWorkerMethod();
                $this->_create(self::PROP_CLASS_NAME, $class);
                $this->_create(self::PROP_METHOD_NAME, $method);
                $object = new $class;
                $callable = [$object, $method];
                if (is_callable($callable)) {
                    $this->_callable = $callable;
                }else {
                    throw new \RuntimeException("Class[$class] and method[$method] is not callable.");
                }
            }catch(\Throwable $throwable){
                throw new Exception($throwable->getMessage(), Exception::CODE_CANNOT_INSTANTIATE_WORKER, $throwable);
            }
        }

        return $this->_callable;
    }

    public function getMethodName(): string
    {
        return $this->_read(self::PROP_METHOD_NAME);
    }

    public function getClassName(): string
    {
        return $this->_read(self::PROP_CLASS_NAME);
    }
}