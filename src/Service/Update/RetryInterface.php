<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Update;

use NHDS\Jobs\ServiceInterface;

interface RetryInterface extends ServiceInterface
{
    public function setDateTime(\DateTime $dateTime): RetryInterface;
}