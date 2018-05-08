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
        while (random_int(0, 3)) {
            $newJobScheduler = $this->_getApiV1WorkerService()->getNewJobScheduler();
            $newJobScheduler->setJobTypeCode('type_code_1')
                            ->setWorkAtDateTime(new \DateTime('now'))
                            ->save()
                            ->getJobId();
        }
        $this->_getApiV1WorkerService()->requestCompleteSuccess()->applyRequest();

        return $this;
    }
}