<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Work;

use Neighborhoods\Kojo\Service\Update\WorkInterface;

interface FactoryInterface
{
    public function create(): WorkInterface;
}