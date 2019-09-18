<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Semaphore;

class StateTransitionLogger extends Forked implements StateTransitionLoggerInterface
{
    use Semaphore\Resource\Factory\AwareTrait;

    public const TYPE_CODE = 'state_transition_logger';

    protected function _run(): Forked
    {
        $this->_getLogger()->debug('State Transition Logger has been instantiated');

        if ($this->_getSemaphoreResource('state_transition_logger')->testAndSetLock()) {
            $this->_getLogger()->debug('State Transition Logger has acquired mutex');

            // TODO: replace with business logic
            while (true) {
                sleep(1);
            }
        } else {
            $this->_getLogger()->debug('State Transition Logger failed to acquire mutex');
        }

        return $this;
    }
}
