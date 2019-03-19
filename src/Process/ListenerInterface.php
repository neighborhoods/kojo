<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

interface ListenerInterface extends ProcessInterface
{
    public function processMessage(): ListenerInterface;

    public function hasMessages(): bool;
}
