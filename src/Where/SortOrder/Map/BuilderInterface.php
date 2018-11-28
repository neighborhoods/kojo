<?php

namespace Neighborhoods\Kojo\Where\SortOrder\Map;

use Neighborhoods\Kojo\Where\SortOrder\MapInterface;

interface BuilderInterface
{
    public function build(): MapInterface;

    public function setFrom(array $from): BuilderInterface;
}
