<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Exception\Runtime;

class Exception extends \RuntimeException implements ExceptionInterface
{
    protected $_possibleMessages = [];

    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->_addPossibleMessage(self::CODE_ANONYMOUS, 'Anonymous Exception code.');

        if ($code === 0) {
            $code = self::CODE_ANONYMOUS;
        }
        $this->_init($message, $code);

        return $this;
    }

    protected function _addPossibleMessage($code, $message)
    {
        $this->_possibleMessages[$code] = $message;

        return $this;
    }

    protected function _init($message, $code)
    {
        if ($message === null) {
            $this->_addMessage($code);
        }

        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        $this->message = '';
        $this->_addMessage($code);

        return $this;
    }

    protected function _addMessage($code)
    {
        $messages = $this->_getMessages();
        if (isset($messages[$code])) {
            $message = $messages[$code];
        }else {
            $message = $messages[$code];
        }

        $this->_pushMessage($message);

        return $this;
    }

    protected function _getMessages()
    {
        $possibleMessages = $this->_getPossibleMessages();

        return $possibleMessages;
    }

    protected function _getPossibleMessages()
    {
        return $this->_possibleMessages;
    }

    protected function _pushMessage($message)
    {
        if ($this->message === "") {
            $messages = array();
        }else {
            $messages = json_decode($this->message);
        }

        $messages[] = $message;
        $this->message = json_encode($messages);

        return $this;
    }

    public function addMessage($additionalMessage)
    {
        $this->_pushMessage($additionalMessage);

        return $this;
    }

    public function getPrettyPrintMessages()
    {
        $prettyPrintMessages = "";
        $messages = json_decode($this->getMessage());
        foreach ($messages as $message) {
            $prettyPrintMessages .= $message . "\n";
        }

        return $prettyPrintMessages;
    }
}