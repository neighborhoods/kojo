<?php

namespace Neighborhoods\Kojo\Where\Filter\Map;

use Neighborhoods\Kojo\Where\Filter\MapInterface;

interface BuilderInterface
{
    public function build(): MapInterface;

    public function setFrom(array $from): BuilderInterface;
}
