<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process;

use Neighborhoods\Kojo\ProcessInterface;

interface FromProcessInterfaceInterface extends \JsonSerializable
{

    public function jsonSerialize();

    public function setProcessInterface(ProcessInterface $processInterface) : FromProcessInterfaceInterface;
}
