<?php
declare(strict_types=1);

namespace Neighborhoods\AreaService\Exception\Runtime;

class Exception extends \RuntimeException implements ExceptionInterface
{
    public const CODE_ANONYMOUS = self::CODE_PREFIX . 'anonymous';
    public const CODE_PREFIX = self::class . '-';
    protected $possibleMessages = [];

    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->addPossibleMessage(self::CODE_ANONYMOUS, 'Anonymous Exception code.');

        if ($code === 0) {
            $code = self::CODE_ANONYMOUS;
        }
        $this->initialize($message, $code);

        return $this;
    }

    protected function addPossibleMessage($code, $message)
    {
        $this->possibleMessages[$code] = $message;

        return $this;
    }

    protected function initialize($message, $code)
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
        $messages = $this->getMessages();
        if (isset($messages[$code])) {
            $message = $messages[$code];
        } else {
            $message = $messages[$code];
        }

        $this->pushMessage($message);

        return $this;
    }

    protected function getMessages()
    {
        $possibleMessages = $this->getPossibleMessages();

        return $possibleMessages;
    }

    protected function getPossibleMessages()
    {
        return $this->possibleMessages;
    }

    protected function pushMessage($message)
    {
        if ($this->message === "") {
            $messages = array();
        } else {
            $messages = json_decode($this->message);
        }

        $messages[] = $message;
        $this->message = json_encode($messages);

        return $this;
    }

    public function addMessage($additionalMessage)
    {
        $this->pushMessage($additionalMessage);

        return $this;
    }

    public function jsonSerialize()
    {
        $prettyPrintMessages = "";
        $messages = json_decode($this->getMessage());
        foreach ($messages as $message) {
            $prettyPrintMessages .= $message . "\n";
        }

        return $prettyPrintMessages;
    }
}