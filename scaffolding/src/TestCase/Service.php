<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding\TestCase;

use Neighborhoods\Scaffolding\Fixture\Expression\Value;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Service implements ServiceInterface
{
    use Defensive\AwareTrait;
    use Value\AwareTrait;
}