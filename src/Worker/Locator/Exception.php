<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_CANNOT_INSTANTIATE_WORKER = self::CODE_PREFIX . 'cannot_instantiate_worker';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_CANNOT_INSTANTIATE_WORKER, 'Cannot instantiate worker.');

        return $this;
    }
}
