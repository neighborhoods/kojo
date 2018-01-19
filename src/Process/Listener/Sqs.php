<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Listener;

use NHDS\Jobs\Process\Forkable;
use NHDS\Jobs\Process\ListenerAbstract;
use NHDS\Jobs\Process\ListenerInterface;
use NHDS\Jobs\Worker\Bootstrap;

class Sqs extends ListenerAbstract implements CommandInterface
{
    use Bootstrap\AwareTrait;

    public function processMessages(): ListenerInterface
    {
        // TODO: Implement processMessages() method.
    }

    public function hasMessages(): bool
    {
        // TODO: Implement hasMessages() method.
    }

    protected function _run(): Forkable
    {
        $this->_getBootstrap()->instantiate();

        return $this;
    }
}