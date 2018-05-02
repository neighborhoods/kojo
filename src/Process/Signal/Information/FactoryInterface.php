<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information;

use Neighborhoods\Kojo\Process\Signal\InformationInterface;

interface FactoryInterface
{
    public function create(): InformationInterface;
}