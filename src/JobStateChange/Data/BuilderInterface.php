<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data;

use Neighborhoods\Kojo\JobStateChange\DataInterface;

interface BuilderInterface
{
    public function build() : DataInterface;

    public function setRecord(array $record) : BuilderInterface;
}
