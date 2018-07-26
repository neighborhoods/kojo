<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create;

use Neighborhoods\Kojo\Service\CreateInterface;

interface BuilderInterface
{
    public function build(): CreateInterface;
}