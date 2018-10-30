<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo;

class Exception extends Kojo\Runtime\Exception implements ExceptionInterface
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_CANNOT_INSTANTIATE_WORKER = self::CODE_PREFIX . 'cannot_instantiate_worker';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_CANNOT_INSTANTIATE_WORKER, 'Cannot instantiate worker.');

        return $this;
    }
}
