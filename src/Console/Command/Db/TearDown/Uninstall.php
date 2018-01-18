<?php
declare(strict_types=1);

namespace NHDS\Jobs\Console\Command\Db\TearDown;

use NHDS\Jobs\Console\CommandAbstract;
use NHDS\Jobs\Worker\Bootstrap;
use NHDS\Jobs\Db\TearDown;

class Uninstall extends CommandAbstract
{
    use Bootstrap\AwareTrait;
    use TearDown\AwareTrait;

    protected function _configure(): CommandAbstract
    {
        $this->setName('db:teardown:uninstall');
        $this->setDescription('Uninstalls Jobs from the persistent storage engine.');
        $this->setHelp($this->_getHelp());

        return $this;
    }

    public function _execute(): CommandAbstract
    {
        $this->_getBootstrap()->instantiate();
        $this->_getDbTearDown()->uninstall();

        return $this;
    }

    protected function _getHelp(): string
    {
        return <<<'EOD'
WARNING: THIS WILL DELETE ALL JOB DATA IN PERSISTENT STORAGE.

This command UNINSTALLS a Jobs cluster from a persistent storage engine.
Currently only \PDO compatible storage engines are supported.
The client's Bootstrap class will be called prior to setup, and that \PDO class will be used for setup. 
EOD;
    }
}