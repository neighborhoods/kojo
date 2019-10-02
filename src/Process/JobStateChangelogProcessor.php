<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Semaphore;

class JobStateChangelogProcessor extends Forked implements JobStateChangelogProcessorInterface
{
    use Semaphore\Resource\Factory\AwareTrait;

    public const TYPE_CODE = 'job_state_changelog_processor';

    protected function _run(): Forked
    {
        $this->_getLogger()->debug('JobStateChangelogProcessor has been instantiated');

        if ($this->_getSemaphoreResource('job_state_changelog_processor')->testAndSetLock()) {
            $this->_getLogger()->debug('JobStateChangelogProcessor has acquired mutex');

            // TODO: replace with business logic
            while (true) {
                sleep(1);
            }
        } else {
            $this->_getLogger()->debug('JobStateChangelogProcessor failed to acquire mutex');
        }

        return $this;
    }
}
