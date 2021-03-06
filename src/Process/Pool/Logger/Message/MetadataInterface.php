<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\HostInterface;

interface MetadataInterface extends \JsonSerializable
{

    public function setJob(JobInterface $job) : MetadataInterface;

    public function getProcess() : SerializableProcessInterface;

    public function getJob() : JobInterface;

    public function setProcess(SerializableProcessInterface $process) : MetadataInterface;

    public function hasJob() : bool;

    public function hasProcess() : bool;

    public function setHost(HostInterface $host) : MetadataInterface;

    public function getHost() : HostInterface;
}
