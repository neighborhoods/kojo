<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Semaphore\Resource\Owner;

use Neighborhoods\Kojo\Semaphore\Resource\OwnerInterface;
use Neighborhoods\Kojo\Data;

interface JobInterface extends OwnerInterface
{
    public function setJob(Data\JobInterface $job);
}