<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo;

interface ExceptionInterface extends Kojo\Runtime\ExceptionInterface
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_CANNOT_INSTANTIATE_WORKER = self::CODE_PREFIX . 'cannot_instantiate_worker';
}
