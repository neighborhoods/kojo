<?php

namespace NHDS\Jobs\Console\Command\Process\Pool\Server;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Start extends Command
{
    const ARG_SERVICES_YML_FILE_PATH = 'services_yml_file_path';
    const OPT_SERVICES_YML_FILE_PATH = 'services-yml-file-path';

    protected function configure()
    {
        $this->setName('process:pool:server:start');
        $this->setDescription('Starts a new process pool server.');
        $this->setHelp($this->_getHelp());
        $this->addArgument(
            self::ARG_SERVICES_YML_FILE_PATH,
            InputArgument::REQUIRED,
            'The path to the YML services file for the consuming application.'
        );
        $this->addOption(
            self::OPT_SERVICES_YML_FILE_PATH,
            'syfp',
            InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            'Additional YML services file paths to load. These are loaded in the order provided.'
        );

        return $this;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            [
                'NHDS Jobs - A distributed task manager.',
                '=======================================',
                '',
            ]
        );
        $arguments = ['ysfp:' . $input->getArgument(self::ARG_SERVICES_YML_FILE_PATH)];
        foreach ($input->getOption(self::OPT_SERVICES_YML_FILE_PATH) as $servicesYmlFilePath) {
            $arguments[] = 'ysfp:' . $servicesYmlFilePath;
        }
        pcntl_exec(__DIR__ . '/../../../../../bin/server', $arguments);
        $output->writeln('An error occurred trying to start the process pool server.');

        return $this;
    }

    protected function _getHelp()
    {
        return <<<'EOD'
This command allows you start a new process pool server. Currently only one server can run at a time for a given machine.
If a server is already running this command will return immediately.
More than one server and named servers will be available in future releases.
EOD;
    }
}