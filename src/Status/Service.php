<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Status;

use Neighborhoods\Kojo\Data\Status;
use Neighborhoods\Pylon\Data;

class Service implements ServiceInterface
{
    use Status\AwareTrait;
    use Data\Property\Defensive\AwareTrait;

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