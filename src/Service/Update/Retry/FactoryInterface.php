<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Retry;

use Neighborhoods\Kojo\Service\Update\RetryInterface;

interface FactoryInterface
{
    public function create(): RetryInterface;
}