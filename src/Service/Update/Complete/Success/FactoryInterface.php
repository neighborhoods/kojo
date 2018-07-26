<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success;

use Neighborhoods\Kojo\Service\Update\Complete\SuccessInterface;

interface FactoryInterface
{
    public function create(): SuccessInterface;
}