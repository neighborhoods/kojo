<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener;

use Neighborhoods\Kojo\Process\Forked;
use Neighborhoods\Kojo\Process\Forked\Exception;
use Neighborhoods\Kojo\Process\ListenerAbstract;
use Neighborhoods\Kojo\Process\ListenerInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Command extends ListenerAbstract implements CommandInterface
{
    protected const PROP_EXPRESSION_LANGUAGE = 'expression_language';

    public function hasMessages(): bool
    {
        return $this->_getMessageBroker()->hasMessage();
    }

    public function processMessage(): ListenerInterface
    {
        $message = $this->_getMessageBroker()->attemptGetNextMessage();

        if ($message !== null) {
            if (json_decode($message) !== null) {
                $this->_getExpressionLanguage()->evaluate(
                    json_decode($message, true)['command'],
                    [
                        'commandProcess' => $this,
                    ]
                );
            } else {
                $this->_getLogger()->warning('The message is not a JSON: "' . $message . '".');
            }
        }

        return $this;
    }

    public function addProcess(string $processTypeCode): CommandInterface
    {
        $process = $this->_getProcessCollection()->getProcessPrototypeClone($processTypeCode);
        try {
            $this->_getProcessPool()->addChildProcess($process);
        } catch (Exception $forkedException) {
            $this->_getLogger()->critical($forkedException->getMessage(), ['exception' => $forkedException]);
        }

        return $this;
    }

    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage): CommandInterface
    {
        $this->_create(self::PROP_EXPRESSION_LANGUAGE, $expressionLanguage);

        return $this;
    }

    protected function _getExpressionLanguage(): ExpressionLanguage
    {
        return $this->_read(self::PROP_EXPRESSION_LANGUAGE);
    }

    protected function _run(): Forked
    {
        if (!$this->_getMessageBroker()->hasMessage()) {
            $this->_getMessageBroker()->waitForNewMessage();
        }

        return $this;
    }

    protected function _registerSignalHandlers(): ProcessInterface
    {
        $this->getProcessSignalDispatcher()->ignoreSignal(SIGCHLD);
        $this->getProcessSignalDispatcher()->ignoreSignal(SIGALRM);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGTERM, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGINT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGHUP, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGQUIT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGABRT, $this, false);
        $this->getProcessSignalDispatcher()->registerSignalHandler(SIGUSR1, $this, false);
        $this->_getLogger()->debug('Registered signal handlers.');

        return $this;
    }
}
