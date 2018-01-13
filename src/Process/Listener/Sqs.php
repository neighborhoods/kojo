<?php

namespace NHDS\Jobs\Process\Listener;

use NHDS\Jobs\Process\ListenerAbstract;
use NHDS\Jobs\Process\ListenerInterface;
use NHDS\Jobs\ProcessAbstract;

class Sqs extends ListenerAbstract implements CommandInterface
{
    public function processMessages(): ListenerInterface
    {
        // TODO: Implement processMessages() method.
    }

    public function hasMessages(): bool
    {
        // TODO: Implement hasMessages() method.
    }

    protected function _run(): ProcessAbstract
    {
        // TODO: Implement _run() method.
    }
}