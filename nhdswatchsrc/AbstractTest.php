<?php

namespace NHDS\Watch;

use PHPUnit\Framework\TestCase;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Watch\TestCase\Service;
use NHDS\Watch\TestCase\ContainerBuilder;

abstract class AbstractTest extends TestCase
{
    use ContainerBuilder\AwareTrait;
    use Strict\AwareTrait;
    use Service\AwareTrait;

    public function setUp()
    {
        $yamlServiceFilePath = dirname(__FILE__) . '/config/root.yml';
        $this->addServicesYmlFilePath($yamlServiceFilePath);
        $testCaseService = $this->getContainerBuilder()->get('nhds.watch.testcase.service');
        $this->setTestCaseService($testCaseService);

        parent::setUp();
    }
}