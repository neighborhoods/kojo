<?php

namespace NHDS\Jobs\Console\Command\Process\Pool\Server;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Start extends Command
{
    protected function configure()
    {
        $this->setName('server:start');
        $this->setDescription('Attempts to start a new process pool server.');
        $this->setHelp('This command allows you start a new process pool server');

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
        pcntl_exec(__DIR__ . '/../../../../../bin/server');
        $output->writeln('An error occurred trying to start the process pool server.');

        return $this;
    }
}