<?php

namespace NHDS\Jobs\Process\Type\Listener;

use NHDS\Jobs\AbstractProcess;
use NHDS\Jobs\Process\Type;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Command extends Type\AbstractListener
{
    const PROP_EXPRESSION_LANGUAGE = 'expression_language';

    public function hasMessages(): bool
    {
        return $this->_getMessageBroker()->hasMessage();
    }

    public function processMessages(): Type\ListenerInterface
    {
        foreach ($this->_getMessageBroker()->getNextMessage() as $message) {
            $this->_getLogger()->debug('Received message: ' . var_export($message, true));
            $this->_getExpressionLanguage()->evaluate(
                json_decode($message, true)['command'],
                [
                    'commandProcess' => $this,
                ]
            );
        }

        return $this;
    }

    public function addProcess($processTypeCode): Command
    {
        $this->_getPool()->addProcess($this->_getProcessTypeClone($processTypeCode));

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

    protected function _run(): AbstractProcess
    {
        $this->_getMessageBroker()->waitForNewMessage();

        return $this;
    }
}