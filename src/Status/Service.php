<?php
declare(strict_types=1);

namespace NHDS\Jobs\Status;

use NHDS\Jobs\Data\Status;

class Service implements ServiceInterface
{
    use Status\AwareTrait;

    public function addCritical(string $message, string $code): ServiceInterface
    {
        return $this;
    }

    public function addInformation(string $message, string $code): ServiceInterface
    {
        return $this;
    }

    public function addError(string $message, string $code): ServiceInterface
    {
        return $this;
    }

    public function finalize(): ServiceInterface
    {
        return $this;
    }
}