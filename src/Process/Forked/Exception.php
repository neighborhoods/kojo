<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Forked;

use Neighborhoods\Kojo\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_FORK_FAILED = self::CODE_PREFIX . 'fork_failed';

    public function __construct()
    {
        parent::__construct();

        $this->addPossibleMessage(self::CODE_FORK_FAILED, 'Failed to fork a new process.');

        return $this;
    }
}
