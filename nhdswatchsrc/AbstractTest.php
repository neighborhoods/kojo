<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding;

use PHPUnit\Framework\TestCase;
use Neighborhoods\Toolkit\Data\Property\Strict;
use Neighborhoods\Scaffolding\TestCase\Service;
use Neighborhoods\Scaffolding\TestCase\ContainerBuilder;

abstract class AbstractTest extends TestCase
{
    use ContainerBuilder\AwareTrait;
    use Strict\AwareTrait;
    use Service\AwareTrait;

    public function setUp()
    {
        ini_set('assert.exception', '1');
        $ymlServiceFilePath = dirname(__FILE__) . '/config/root.yml';
        $this->addServicesYmlFilePath($ymlServiceFilePath);
        $testCaseService = $this->getContainerBuilder()->get('nhds.watch.testcase.service');
        $this->setTestCaseService($testCaseService);

        parent::setUp();
    }
}