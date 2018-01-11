<?php

namespace NHDS\Jobs\Console\Command\Db\Setup;

use NHDS\Jobs\Console\CommandAbstract;
use NHDS\Jobs\Worker\Bootstrap;
use NHDS\Jobs\Db\Setup;

class Install extends CommandAbstract
{
    use Bootstrap\AwareTrait;
    use Setup\AwareTrait;

    protected function _configure(): CommandAbstract
    {
        $this->setName('db:setup:install');
        $this->setDescription('Installs Jobs to persistent a storage engine.');
        $this->setHelp($this->_getHelp());

        return $this;
    }

    public function _execute(): CommandAbstract
    {
        $this->_getBootstrap()->instantiate();
        $this->_getDbSetup()->install();

        return $this;
    }

    protected function _getHelp(): string
    {
        return <<<'EOD'
This command installs a Jobs cluster on a persistent storage engine.
Currently only \PDO compatible storage engines are supported.
The client's Bootstrap class will be called prior to setup, and that \PDO class will be used for setup. 
EOD;
    }
}