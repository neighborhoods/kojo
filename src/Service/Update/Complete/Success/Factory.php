<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Success;

use Neighborhoods\Kojo\Service\Update\Complete\SuccessInterface;
use Neighborhoods\Kojo\Service\Update\Complete\Success;
use Neighborhoods\Kojo\State\Service;

class Factory implements FactoryInterface
{
    use Success\AwareTrait;
    use Service\AwareTrait;

    public function create(): SuccessInterface
    {
        $updateCompleteSuccess = $this->_getServiceUpdateCompleteSuccessClone();
        $stateService = $this->_getStateServiceClone();
        $updateCompleteSuccess->setStateService($stateService);

        return $updateCompleteSuccess;
    }
}