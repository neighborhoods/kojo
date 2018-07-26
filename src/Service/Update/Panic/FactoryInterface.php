<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Panic;

use Neighborhoods\Kojo\Service\Update\PanicInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function create(): PanicInterface;
}