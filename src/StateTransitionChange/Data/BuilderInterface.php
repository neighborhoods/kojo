<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange\Data;

use Neighborhoods\Kojo\StateTransitionChange\DataInterface;

interface BuilderInterface
{
    public function build() : DataInterface;

    public function setRecord(array $record) : BuilderInterface;
}
