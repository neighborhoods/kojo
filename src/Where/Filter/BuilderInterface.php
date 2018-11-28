<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\Filter;

use Neighborhoods\Kojo\Where\FilterInterface;

interface BuilderInterface
{
    public function build(): FilterInterface;

    public function setFrom(array $from): BuilderInterface;
}
