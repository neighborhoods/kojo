<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Listener;

use NHDS\Jobs\Process\Forked;
use NHDS\Jobs\Process\ListenerInterface;
use NHDS\Jobs\Process\ListenerAbstract;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Command extends ListenerAbstract implements CommandInterface
{
    const PROP_EXPRESSION_LANGUAGE = 'expression_language';

    public function hasMessages(): bool
    {
        return $this->_getMessageBroker()->hasMessage();
    }

    public function processMessages(): ListenerInterface
    {
        $message = $this->_getMessageBroker()->getNextMessage();
        if (json_decode($message) !== null) {
            $this->_getExpressionLanguage()->evaluate(
                json_decode($message, true)['command'],
                [
                    'commandProcess' => $this,
                ]
            );
        }else {
            $this->_getLogger()->warning('The message is not a JSON: "' . $message . '".');
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

    public function setExpressionLanguage(ExpressionLanguage $expressionLanguage): Command
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
}