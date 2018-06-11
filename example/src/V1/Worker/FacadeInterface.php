<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker;

interface FacadeInterface
{
    public function start(): FacadeInterface;
}