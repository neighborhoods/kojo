<?php

namespace NHDS\Jobs\Test\Unit;

use PHPUnit\Framework\TestCase;
use NHDS\Jobs\Data\Property\Crud;
use \NHDS\Jobs\Test\Unit\ContainerBuilder;

abstract class AbstractTest extends TestCase
{
    use Crud\AwareTrait;
    use ContainerBuilder\AwareTrait;
}