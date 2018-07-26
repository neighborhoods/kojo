<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding\TestCase\Service;

use Neighborhoods\Scaffolding\TestCase;

trait AwareTrait
{
    protected $_testCaseService;

    public function setTestCaseService(TestCase\Service $testCaseService)
    {
        if ($this->_testCaseService === null) {
            $this->_testCaseService = $testCaseService;
        }else {
            throw new \LogicException('Test case service is already set.');
        }

        return $this;
    }

    protected function _getTestCaseService(): TestCase\Service
    {
        if ($this->_testCaseService === null) {
            throw new \LogicException('Test case service is not set.');
        }

        return $this->_testCaseService;
    }
}