<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker;

use Neighborhoods\Kojo\Example\Worker;
use Neighborhoods\Pylon\Data;

class Delegate implements DelegateInterface
{
    use Data\Property\Defensive\AwareTrait;
    use Worker\Queue\Message\AwareTrait;

    public function businessLogic(): DelegateInterface
    {
        return $this;
    }
}