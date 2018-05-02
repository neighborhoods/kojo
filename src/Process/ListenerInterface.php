<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\ProcessInterface;

interface ListenerInterface extends ProcessInterface
{
    public function processMessages(): ListenerInterface;

    public function hasMessages(): bool;
}