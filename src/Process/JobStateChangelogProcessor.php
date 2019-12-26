<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process\Signal\HandlerInterface;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;
use Neighborhoods\Kojo\ProcessInterface;
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

    protected function _registerSignalHandlers() : ProcessInterface
    {
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGCHLD, $this->_getProcessPool(), true);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGALRM, $this->_getProcessPool(), true);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGQUIT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGTERM, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGINT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGHUP, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGABRT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGUSR1, $this, false);
        $this->_getLogger()->debug('Registered signal handlers.');

        return $this;
    }

    public function handleSignal(InformationInterface $signalInformation): HandlerInterface
    {
        $signalNumber = $signalInformation->getSignalNumber();
        switch ($signalNumber) {
            case SIGQUIT:
                $this->_getLogger()->notice('JobStateChangelogProcessor Exiting gracefully');
                $this->exit();
                break;
            default:
                parent::handleSignal($signalInformation);
        }

        return $this;
    }
}
