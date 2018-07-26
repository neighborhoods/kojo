<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed;

use Neighborhoods\Kojo\Service\Update\Complete\FailedInterface;
use Neighborhoods\Kojo\Service\Update\Complete\Failed;
use Neighborhoods\Kojo\State\Service;

class Factory implements FactoryInterface
{
    use Failed\AwareTrait;
    use Service\AwareTrait;

    public function create(): FailedInterface
    {
        $updateCompleteFailed = $this->_getServiceUpdateCompleteFailed();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteFailed->setStateService($stateService);

        return $updateCompleteFailed;
    }
}