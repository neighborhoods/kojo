<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Crash;

use NHDS\Jobs\Data\Job\Service\Update\CrashInterface;
use NHDS\Jobs\Data\Job\State\Service;
use NHDS\Jobs\Service\FactoryAbstract;
use NHDS\Jobs\Data\Job\Service\Update\Crash;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Crash\AwareTrait;
    use Service\AwareTrait;

    public function create(): CrashInterface
    {
        $updateCrash = $this->_getJobServiceUpdateCrashClone();
        $stateService = $this->_getJobStateServiceClone();
        $updateCrash->setJobStateService($stateService);

        return $updateCrash;
    }
}