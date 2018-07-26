<?php
declare(strict_types=1);

namespace Neighborhoods\AreaService\Exception\Runtime;

interface ExceptionInterface extends \Throwable, \JsonSerializable
{
    public function setCode($code);

    public function addMessage($additionalMessage);

    public function jsonSerialize();
}