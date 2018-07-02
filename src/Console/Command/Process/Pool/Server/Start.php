<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console\Command\Process\Pool\Server;

use Neighborhoods\Kojo\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputOption;

class Start extends CommandAbstract
{
    const OPT_SERVICES_YML_DIRECTORY_PATH = 'services-yml-directory-path';
    const OPT_YSDP                        = 'ysdp';
    const OPT_RUN_SERVER                  = '--run-server';
    const COMMAND_NAME                    = 'process:pool:server:start';
    const COMMAND_NAME_ALIASES            = ['gō-gō'];

    protected function _configure(): CommandAbstract
    {
        $this->setName(self::COMMAND_NAME);
        $this->setAliases(self::COMMAND_NAME_ALIASES);
        $this->setDescription('Starts a new process pool server.');
        $this->setHelp($this->_getHelp());
        $this->addOption(
            self::OPT_SERVICES_YML_DIRECTORY_PATH,
            self::OPT_YSDP,
            InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            'Additional YML services directory paths to load. These are loaded in the order provided.'
        );

        return $this;
    }

    public function _execute(): CommandAbstract
    {
        $arguments = [self::OPT_RUN_SERVER];
        $arguments[] = self::OPT_YSDP . $this->_getInput()->getArgument(self::ARG_SERVICES_YML_ROOT_DIRECTORY_PATH);
        foreach ($this->_getInput()->getOption(self::OPT_SERVICES_YML_DIRECTORY_PATH) as $servicesYmlFilePath) {
            $arguments[] = self::OPT_YSDP . $servicesYmlFilePath;
        }
        pcntl_exec(__DIR__ . '/../../../../../../bin/kojo', $arguments);
        $this->_getOutput()->writeln('An error occurred trying to start the process pool server.');

        return $this;
    }

    protected function _getHelp()
    {
        return <<<'EOD'
This command starts a new collection of process pool servers. 
The number of process pool servers that are started is defined in the dependency injection YML files.
The default number of servers started is one.
EOD;
    }
}