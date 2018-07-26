<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Listener;

use Neighborhoods\Kojo\Process\Forked;
use Neighborhoods\Kojo\Process\ListenerInterface;
use Neighborhoods\Kojo\Symfony;

class Command extends Forked implements CommandInterface
{
    use Symfony\Component\ExpressionLanguage\ExpressionLanguage\AwareTrait;

    public function hasMessages(): bool
    {
        return $this->_getMessageBroker()->hasMessage();
    }

    public function processMessages(): ListenerInterface
    {
        $message = $this->_getMessageBroker()->getNextMessage();
        if (json_decode($message) !== null) {
            $this->getSymfonyComponentExpressionLanguageExpressionLanguage()->evaluate(
                json_decode($message, true)['command'],
                [
                    'commandProcess' => $this,
                ]
            );
        } else {
            $this->getLogger()->warning('The message is not a JSON: "' . $message . '".');
        }

        return $this;
    }

    public function addProcess(string $processTypeCode): Command
    {
        $process = $this->_getProcessCollection()->getProcessPrototypeClone($processTypeCode);
        $this->_getProcessPool()->addChildProcess($process);

        return $this;
    }

    public function setAlarm(int $seconds): Command
    {
        $this->_getProcessPool()->setAlarm($seconds);

        return $this;
    }

    protected function run(): Forked
    {
        if (!$this->_getMessageBroker()->hasMessage()) {
            $this->_getMessageBroker()->waitForNewMessage();
        }

        return $this;
    }
}