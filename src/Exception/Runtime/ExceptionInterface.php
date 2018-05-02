<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Exception\Runtime;

interface ExceptionInterface extends \Throwable
{
    public const CODE_ANONYMOUS = self::CODE_PREFIX . 'anonymous';
    public const CODE_PREFIX    = self::class;

    public function setCode($code);

    public function addMessage($additionalMessage);

    public function getPrettyPrintMessages();
}