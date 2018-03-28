<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console\Command\Db\Setup;

use Neighborhoods\Kojo\Console\CommandAbstract;
use Neighborhoods\Kojo\Worker\Bootstrap;
use Neighborhoods\Kojo\Db\Setup;

class Install extends CommandAbstract
{
    use Bootstrap\AwareTrait;
    use Setup\AwareTrait;

    protected function _configure(): CommandAbstract
    {
        $this->setName('db:setup:install');
        $this->setDescription('Installs Kojo to a persistent storage engine.');
        $this->setHelp($this->_getHelp());

        return $this;
    }

    public function _execute(): CommandAbstract
    {
        $this->_getBootstrap()->instantiate();
        $this->_getDbSetup()->install();
        $this->_getOutput()->writeln('Kojo has been successfully installed.');

        return $this;
    }

    protected function _getHelp(): string
    {
        return <<<'EOD'
This command installs a Kojo cluster on a persistent storage engine.
Currently only \PDO compatible storage engines are supported.
The client's Bootstrap class will be called prior to setup, and that \PDO class will be used for setup. 
EOD;
    }
}