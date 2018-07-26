<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use \Neighborhoods\AreaService\Exception\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_CANNOT_INSTANTIATE_WORKER = self::CODE_PREFIX . 'cannot_instantiate_worker';

    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->addPossibleMessage(self::CODE_CANNOT_INSTANTIATE_WORKER, 'Cannot instantiate worker.');

        return parent::__construct($message, $code, $previous);
    }
}