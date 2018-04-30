<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example;

use Neighborhoods\Kojo\Api;
use Neighborhoods\Pylon\Data\Property;

class Worker
{
    use Api\V1\Worker\Service\AwareTrait;
    use Property\Defensive\AwareTrait;

    public function work()
    {
        return $this;
    }
}