<?php
declare(strict_types=1);


namespace Neighborhoods\Kojo\Process\Pool\Logger;

interface MessageInterface
{

    public function getTime() : string;

    public function setTime(string $time) : MessageInterface;

    public function getLevel() : string;

    public function setLevel(string $level) : MessageInterface;

    public function getProcessId() : string;

    public function setProcessId(string $process_id) : MessageInterface;

    public function getProcessPath() : string;

    public function setProcessPath(string $process_path) : MessageInterface;

    public function getMessage() : string;

    public function setMessage(string $message) : MessageInterface;
}
