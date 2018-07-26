<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

interface BuilderInterface
{
    public function build(): JobInterface;
}