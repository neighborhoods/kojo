<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create;

use Neighborhoods\Kojo\Service\CreateInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use State\Service\Factory\AwareTrait;
    use Kojo\Job\Collection\ScheduleLimit\Factory\AwareTrait;
    use Kojo\Job\Repository\AwareTrait;

    public function build(): CreateInterface
    {
        $create = $this->getServiceCreateFactory()->create();
        $stateService = $this->getStateServiceFactory()->create();
        $create->setStateService($stateService);
        $create->setJob($this->getJobRepository()->create());

        return $create;
    }
}