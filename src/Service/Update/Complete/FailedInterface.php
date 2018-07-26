<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete;

interface FailedInterface
{
    public function save(): FailedInterface;
}