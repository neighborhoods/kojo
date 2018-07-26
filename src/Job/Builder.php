<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    public function build(): JobInterface
    {
        $job = $this->getJobFactory()->create();

        // @TODO - build the object.

        return $job;
    }
}