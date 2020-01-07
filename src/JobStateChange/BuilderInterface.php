<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\JobStateChangeInterface;

interface BuilderInterface
{
    public function build() : JobStateChangeInterface;

    public function setRecord(array $record) : BuilderInterface;
}
