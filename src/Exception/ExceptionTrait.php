<?php

namespace NHDS\Jobs\Exception;

trait ExceptionTrait
{
    protected $_possibleMessages = [];

    protected function _init($message, $code)
    {
        if ($message === null) {
            $this->_addMessage($code);
        }

        return $this;
    }

    protected function _getPossibleMessages()
    {
        return $this->_possibleMessages;
    }

    public function setCode($code)
    {
        $this->code = $code;
        $this->message = '';
        $this->_addMessage($code);

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

    protected function _getMessages()
    {
        $possibleMessages = $this->_getPossibleMessages();

        return $possibleMessages;
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

    protected function _addPossibleMessage($code, $message)
    {
        $this->_possibleMessages[$code] = $message;

        return $this;
    }
}