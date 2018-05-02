<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Status;

use Neighborhoods\Kojo\Data\StatusInterface;

interface ServiceInterface
{
    public function setStatus(StatusInterface $status);

    public function addCritical(string $message, string $code): ServiceInterface;

    public function addInformation(string $message, string $code): ServiceInterface;

    public function addError(string $message, string $code): ServiceInterface;

}