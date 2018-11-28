<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Ask;

use Neighborhoods\Kojo\AskInterface;

interface BuilderInterface
{
    public function build(): AskInterface;

    public function setFrom(array $from): BuilderInterface;
}
