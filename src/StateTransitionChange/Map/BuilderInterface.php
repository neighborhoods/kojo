<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Map;

use Neighborhoods\Kojo\StateTransitionChange\MapInterface;

interface BuilderInterface
{
    public function build() : MapInterface;

    public function setRecords(array $records) : BuilderInterface;
}
