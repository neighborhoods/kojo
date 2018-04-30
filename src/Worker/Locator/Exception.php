<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo\Exception\Runtime;

class Exception extends Runtime\Exception implements ExceptionInterface
{
    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->_addPossibleMessage(self::CODE_CANNOT_INSTANTIATE_WORKER, 'Cannot instantiate worker.');

        return parent::__construct($message, $code, $previous);
    }
}