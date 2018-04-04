<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Symfony\Component\Console\Input\InputArgument;

abstract class CommandAbstract extends Command
{
    use Defensive\AwareTrait;
    const ARG_SERVICES_YML_FILE_PATH = 'services_yml_file_path';
    const SPLASH_ART                 = [
        '+------------------------------+',
        '|   ⚡ Neighborhoods Kōjō ⚡   |',
        '|                              |',
        '|             工場             |',
        '|                              |',
        '|  A distributed task manager  |',
        '+------------------------------+',
    ];

    public function configure()
    {
        $this->addArgument(
            self::ARG_SERVICES_YML_FILE_PATH,
            InputArgument::REQUIRED,
            'The path to the YML services file for the client application.'
        );

        $this->_configure();

        return $this;
    }

    abstract protected function _configure(): CommandAbstract;

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_setInput($input);
        $this->_setOutput($output);
        $this->_writeSplashArt();
        $this->_execute();

        return $this;
    }

    protected function _setOutput(OutputInterface $output): CommandAbstract
    {
        $this->_create(OutputInterface::class, $output);

        return $this;
    }

    protected function _getOutput(): OutputInterface
    {
        return $this->_read(OutputInterface::class);
    }

    protected function _setInput(InputInterface $input): CommandAbstract
    {
        $this->_create(InputInterface::class, $input);

        return $this;
    }

    protected function _getInput(): InputInterface
    {
        return $this->_read(InputInterface::class);
    }

    abstract function _execute(): CommandAbstract;

    protected function _writeSplashArt(): CommandAbstract
    {
        $this->_getOutput()->writeln(self::SPLASH_ART);

        return $this;
    }
}