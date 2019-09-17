<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\MessageInterface;
use Neighborhoods\Kojo\ProcessInterface;

interface BuilderInterface
{
    public function build() : MessageInterface;

    public function setJob(JobInterface $job) : BuilderInterface;

    public function hasJob() : bool;

    public function hasProcess() : bool;

    public function setProcess(ProcessInterface $process) : BuilderInterface;

    public function setMessage(string $message) : BuilderInterface;

    public function setLevel(string $level) : BuilderInterface;

    public function setContext(array $context) : BuilderInterface;
}
