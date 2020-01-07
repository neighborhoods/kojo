<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job;

use Neighborhoods\Kojo\Data\JobInterface;

interface FromArrayBuilderInterface
{
    public function build() : JobInterface;

    public function setRecord(array $record) : FromArrayBuilderInterface;
}
