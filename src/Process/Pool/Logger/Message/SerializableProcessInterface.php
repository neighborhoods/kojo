<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

interface SerializableProcessInterface extends \JsonSerializable
{

    public function getParentProcessId() : int;

    public function getUuid() : string;

    public function setUuid(string $uuid) : SerializableProcessInterface;

    public function setParentProcessId(int $parent_process_id) : SerializableProcessInterface;

    public function getTypeCode() : string;

    public function getProcessId() : int;

    public function setTypeCode(string $type_code) : SerializableProcessInterface;

    public function setProcessId(int $process_id) : SerializableProcessInterface;

    public function getPath() : string;

    public function setPath(string $path) : SerializableProcessInterface;

    public function getMemoryPeakUsageBytes() : int;

    public function setMemoryUsageBytes(int $memory_usage_bytes) : SerializableProcessInterface;

    public function getMemoryUsageBytes() : int;

    public function setMemoryPeakUsageBytes(int $memory_peak_usage_bytes) : SerializableProcessInterface;

    public function getMemoryLimitBytes() : int;

    public function setMemoryLimitBytes(int $memory_limit_bytes) : SerializableProcessInterface;
}
