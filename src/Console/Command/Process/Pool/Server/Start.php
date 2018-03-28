<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console\Command\Process\Pool\Server;

use Neighborhoods\Kojo\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputOption;

class Start extends CommandAbstract
{
    const OPT_SERVICES_YML_FILE_PATH = 'services-yml-file-path';
    const OPT_RUN_SERVER             = '--run-server';

    protected function _configure(): CommandAbstract
    {
        $this->setName('process:pool:server:start');
        $this->setDescription('Starts a new process pool server.');
        $this->setHelp($this->_getHelp());
        $this->addOption(
            self::OPT_SERVICES_YML_FILE_PATH,
            'syfp',
            InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            'Additional YML services file paths to load. These are loaded in the order provided.'
        );

        return $this;
    }

    public function _execute(): CommandAbstract
    {
        $arguments = [self::OPT_RUN_SERVER];
        $arguments[] = 'ysfp:' . $this->_getInput()->getArgument(self::ARG_SERVICES_YML_FILE_PATH);
        foreach ($this->_getInput()->getOption(self::OPT_SERVICES_YML_FILE_PATH) as $servicesYmlFilePath) {
            $arguments[] = 'ysfp:' . $servicesYmlFilePath;
        }
        pcntl_exec(__DIR__ . '/../../../../../../bin/kojo', $arguments);
        $this->_getOutput()->writeln('An error occurred trying to start the process pool server.');

        return $this;
    }

    protected function _getHelp()
    {
        return <<<'EOD'
This command starts a new process pool server. 
Currently only one server can be run at a time for a given machine.
If a server is already running this command will return immediately.
More than one server and named servers will be available in future releases.
EOD;
    }
}