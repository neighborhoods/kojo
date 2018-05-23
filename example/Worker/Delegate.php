<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker;

use Neighborhoods\KojoExample\Worker;
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