<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;

interface BuilderInterface
{
    public function build(): SortOrderInterface;

    public function setFrom(array $from): BuilderInterface;
}
