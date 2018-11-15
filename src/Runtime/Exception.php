<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Runtime;

class Exception extends \RuntimeException implements ExceptionInterface
{
    public const CODE_ANONYMOUS = self::CODE_PREFIX . 'anonymous';
    public const CODE_PREFIX = self::class . '.';
    protected $possibleMessages = [];

    public function __construct()
    {
        $this->addPossibleMessage(self::CODE_ANONYMOUS, 'An anonymous runtime exception occurred.');
        $this->addMessageFromCode(self::CODE_ANONYMOUS);

        return $this;
    }

    public function setPrevious(\Throwable $previous): ExceptionInterface
    {
        $message = $this->message;
        $code = $this->code;
        parent::__construct('', 0, $previous);
        $this->message = $message;
        $this->code = $code;

        return $this;
    }

    public function addPossibleMessage(string $code, string $message): ExceptionInterface
    {
        $this->possibleMessages[$code] = $message;

        return $this;
    }

    public function setCode(string $code): ExceptionInterface
    {
        $this->code = $code;
        $this->addMessageFromCode($code);

        return $this;
    }

    protected function addMessageFromCode(string $code): ExceptionInterface
    {
        $messages = $this->getMessages();
        if (isset($messages[$code])) {
            $message = $messages[$code];
        } else {
            $message = '';
        }

        $this->addMessage($message);

        return $this;
    }

    protected function getMessages(): array
    {
        $possibleMessages = $this->getPossibleMessages();

        return $possibleMessages;
    }

    protected function getPossibleMessages(): array
    {
        return $this->possibleMessages;
    }

    public function addMessage(string $message): ExceptionInterface
    {
        if ($this->message === '') {
            $messages = array();
        } else {
            $messages = json_decode($this->message);
        }

        $messages[] = $message;
        $this->message = json_encode($messages);

        return $this;
    }

    public function jsonSerialize(): array
    {
        $messages = json_decode($this->getMessage());

        return $messages;
    }
}
