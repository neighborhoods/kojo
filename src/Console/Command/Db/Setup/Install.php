<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console\Command\Db\Setup;

use Neighborhoods\Kojo\Console\CommandAbstract;
use Neighborhoods\Kojo\Db\Setup;

class Install extends CommandAbstract
{
    use Setup\AwareTrait;
    public const COMMAND_NAME = 'db:setup:install';

    protected function _configure(): CommandAbstract
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription('Installs Kōjō to a persistent storage engine.');
        $this->setHelp($this->_getHelp());

        return $this;
    }

    public function _execute(): int
    {
        $this->_getDbSetup()->install();
        $this->_getOutput()->writeln('Kōjō has been successfully installed!');

        return 0;
    }

    protected function _getHelp(): string
    {
        return <<<'EOD'
This command installs a Kōjō cluster on a persistent storage engine.
Currently, only \PDO compatible storage engines are supported.
The client's Bootstrap class will be called prior to setup, and that \PDO class will be used for setup. 
EOD;
    }
}
