<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

interface ProcessInterface extends \JsonSerializable
{

    public function getParentProcessId() : int;

    public function getUuid() : string;

    public function setUuid(string $uuid) : ProcessInterface;

    public function setParentProcessId(int $parent_process_id) : ProcessInterface;

    public function getTypeCode() : string;

    public function getProcessId() : int;

    public function setTypeCode(string $type_code) : ProcessInterface;

    public function setProcessId(int $process_id) : ProcessInterface;
}
