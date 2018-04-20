<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console\Command\Db\TearDown;

use Neighborhoods\Kojo\Console\CommandAbstract;
use Neighborhoods\Kojo\Worker\Bootstrap;
use Neighborhoods\Kojo\Db\TearDown;

class Uninstall extends CommandAbstract
{
    use Bootstrap\AwareTrait;
    use TearDown\AwareTrait;

    protected function _configure(): CommandAbstract
    {
        $this->setName('db:teardown:uninstall');
        $this->setDescription('Uninstalls Kōjō and ALL DATA from the persistent storage engine.');
        $this->setHelp($this->_getHelp());

        return $this;
    }

    public function _execute(): CommandAbstract
    {
        $this->_getBootstrap()->instantiate();
        $this->_getDbTearDown()->uninstall();
        $this->_getOutput()->writeln('Kōjō has been successfully uninstalled.');

        return $this;
    }

    protected function _getHelp(): string
    {
        return <<<'EOD'
WARNING: THIS WILL DELETE ALL JOB DATA IN PERSISTENT STORAGE.

This command UNINSTALLS a Kōjō cluster from a persistent storage engine.
Currently only \PDO compatible storage engines are supported.
The client's Bootstrap class will be called prior to setup, and that \PDO class will be used for setup. 
EOD;
    }
}