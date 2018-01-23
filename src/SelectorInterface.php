<?php
declare(strict_types=1);

namespace NHDS\Jobs;

use NHDS\Jobs\Data\JobInterface;

interface SelectorInterface
{
    public function getWorkableJob(): JobInterface;

    public function hasWorkableJob(): bool;

    public function pick(): SelectorInterface;
}