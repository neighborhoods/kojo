<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update;

interface RetryInterface
{
    public function setDateTime(\DateTime $dateTime): RetryInterface;
}