<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Kojo\Data\JobInterface;

interface BuilderInterface
{
    public function setProcess(ProcessInterface $process) : BuilderInterface;

    public function setJob(JobInterface $job) : BuilderInterface;

    public function build() : MetadataInterface;
}
