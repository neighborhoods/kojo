<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

interface BuilderInterface
{
    public function build() : StateTransitionChangeInterface;

    public function setRecord(array $record) : BuilderInterface;
}
