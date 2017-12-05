<?php

namespace NHDS\Jobs\Exception\Runtime;

use NHDS\Jobs\Exception\ExceptionTrait;

class Exception extends \RuntimeException
{
    const CODE_PREFIX    = '_NHDS_Jobs_Exception_Runtime_Exception_';
    const CODE_ANONYMOUS = self::CODE_PREFIX . 'anonymous';
    use ExceptionTrait;

    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->_addPossibleMessage(self::CODE_ANONYMOUS, 'Anonymous Exception code.');

        if ($code === 0) {
            $code = self::CODE_ANONYMOUS;
        }
        $this->_init($message, $code);

        return $this;
    }
}