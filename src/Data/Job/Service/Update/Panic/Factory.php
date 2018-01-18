<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Panic;

use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Data\Job\Service\Update\Panic;
use NHDS\Jobs\Data\Job\Service\Update\PanicInterface;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Panic\AwareTrait;
    use Service\AwareTrait;

    public function create(): PanicInterface
    {
        $updatePanic = $this->_getJobServiceUpdatePanicClone();
        $stateService = $this->_getJobStateServiceClone();
        $updatePanic->setJobStateService($stateService);

        return $updatePanic;
    }
}