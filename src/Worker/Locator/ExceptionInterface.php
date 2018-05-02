<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo\Exception\Runtime;

interface ExceptionInterface extends Runtime\ExceptionInterface
{
    public const CODE_CANNOT_INSTANTIATE_WORKER = self::CODE_PREFIX . 'cannot_instantiate_worker';
}