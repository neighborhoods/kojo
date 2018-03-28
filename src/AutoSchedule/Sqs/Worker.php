<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\AutoSchedule\Sqs;

use Neighborhoods\Kojo\Data\AutoSchedule\Sqs;

class Worker implements WorkerInterface
{
    use Sqs\AwareTrait;

    public function work(): WorkerInterface
    {

        return $this;
    }
}