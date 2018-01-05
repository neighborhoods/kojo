<?php

namespace NHDS\Jobs\Process\Type\Job;

use NHDS\Jobs\Process\Type\Job;
use NHDS\Jobs\Worker\BootstrapInterface;
use NHDS\Toolkit\Data\Property\Crud;

class Configurator implements ConfiguratorInterface
{
    use Crud\AwareTrait;
    const PROP_PROCESS_TYPE_JOB = 'process_type_job';
    const PROP_WORKER_BOOTSTRAP = 'worker_bootstrap';

    public function configure(Job $job): ConfiguratorInterface
    {
        $this->_create(self::PROP_PROCESS_TYPE_JOB, $job);
        $job->setBootstrap($this->_getWorkerBootstrap());

        return $this;
    }

    protected function _getWorkerBootstrap(): BootstrapInterface
    {
        return $this->_read(self::PROP_WORKER_BOOTSTRAP);
    }

    public function setWorkerBootstrap(BootstrapInterface $bootstrap): ConfiguratorInterface
    {
        $this->_create(self::PROP_WORKER_BOOTSTRAP, $bootstrap);

        return $this;
    }
}