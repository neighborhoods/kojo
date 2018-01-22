<?php
declare(strict_types=1);

namespace NHDS\Jobs\Perpetual;

interface ManagerInterface
{
    public function work(): ManagerInterface;
}