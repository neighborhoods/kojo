<?php

namespace Neighborhoods\Kojo\Where\Filter\Group;

use Neighborhoods\Kojo\Where\Filter\GroupInterface;

interface BuilderInterface
{
    public function build(): GroupInterface;

    public function setFrom(array $from): BuilderInterface;
}
