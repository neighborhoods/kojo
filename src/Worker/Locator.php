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
    protected const PROP_CLASS_NAME = 'class_name';

    public function getCallable(): callable
    {
        if (empty($this->_callable)) {
            try{
                $class = $this->_getJob()->getWorkerUri();
                $this->_create(self::PROP_CLASS_NAME, $class);
                $object = new $class;
                $method = $this->_getJob()->getWorkerMethod();
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

    public function getClass()
    {
        return $this->getCallable()[0];
    }

    public function getClassName(): string
    {
        return $this->_read(self::PROP_CLASS_NAME);
    }
}