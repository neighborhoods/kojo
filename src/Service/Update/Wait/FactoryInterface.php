<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Wait;

use Neighborhoods\Kojo\Service\Update\WaitInterface;

interface FactoryInterface
{
    public function create(): WaitInterface;
}