<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;
use Neighborhoods\Kojo;

interface JobInterface extends OwnerInterface
{
    public function setJob(Kojo\JobInterface $job);
}