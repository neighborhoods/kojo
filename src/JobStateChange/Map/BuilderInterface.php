<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map;

use Neighborhoods\Kojo\JobStateChange\MapInterface;

interface BuilderInterface
{
    public function build() : MapInterface;

    public function setRecords(array $records) : BuilderInterface;
}
