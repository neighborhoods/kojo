<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

abstract class CommandAbstract extends Command
{
    public const ARG_SERVICES_YML_ROOT_DIRECTORY_PATH = 'services_yml_root_directory_path';
    public const OPT_ENABLE_SPLASH_ART = 'enable-splash-art';
    public const OPT_ESA = 'esa';
    public const SPLASH_ART = [
        '+------------------------------+',
        '|   ⚡ Neighborhoods Kōjō ⚡   |',
        '|                              |',
        '|             工場             |',
        '|                              |',
        '|  a distributed task manager  |',
        '+------------------------------+',
    ];
    /** @var \Symfony\Component\Console\Output\OutputInterface */
    protected $output;
    /** @var \Symfony\Component\Console\Input\InputInterface */
    protected $input;

    abstract protected function _configure(): CommandAbstract;

    abstract function _execute(): CommandAbstract;

    public function configure()
    {
        $this->addArgument(
            self::ARG_SERVICES_YML_ROOT_DIRECTORY_PATH,
            InputArgument::REQUIRED,
            'The path to the YML services root directory for the client application.'
        );

        $this->addOption(
            self::OPT_ENABLE_SPLASH_ART,
            self::OPT_ESA,
            InputOption::VALUE_NONE,
            'Enables the splash art to be written to STDOUT.'
        );

        $this->_configure();

        return $this;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setInput($input);
        $this->setOutput($output);
        if ($this->getInput()->getOption(self::OPT_ENABLE_SPLASH_ART)) {
            $this->writeSplashArt();
        }
        $this->_execute();

        return $this;
    }

    public function getOutput(): OutputInterface
    {
        if ($this->output === null) {
            throw new \LogicException('CommandAbstract output has not been set.');
        }

        return $this->output;
    }

    public function setOutput(OutputInterface $output): CommandAbstract
    {
        if ($this->output !== null) {
            throw new \LogicException('CommandAbstract output is already set.');
        }
        $this->output = $output;

        return $this;
    }

    public function getInput(): InputInterface
    {
        if ($this->input === null) {
            throw new \LogicException('CommandAbstract input has not been set.');
        }

        return $this->input;
    }

    public function setInput(InputInterface $input): CommandAbstract
    {
        if ($this->input !== null) {
            throw new \LogicException('CommandAbstract input is already set.');
        }
        $this->input = $input;

        return $this;
    }


    protected function writeSplashArt(): CommandAbstract
    {
        $this->getOutput()->writeln(self::SPLASH_ART);

        return $this;
    }
}