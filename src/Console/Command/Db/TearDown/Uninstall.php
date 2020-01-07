<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Console\Command\Db\TearDown;

use Neighborhoods\Kojo\Console\CommandAbstract;
use Neighborhoods\Kojo\Db\TearDown;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class Uninstall extends CommandAbstract
{
    use TearDown\AwareTrait;
    public const COMMAND_NAME = 'db:tear_down:uninstall';
    public const ANSWER_DELETE_CONFIRMED_BY_USER = 'delete';
    public const ANSWER_DELETE_DECLINED_BY_USER = 'no';
    protected $_question;

    protected function _configure(): CommandAbstract
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription('Uninstalls Kōjō and ALL DATA from the persistent storage engine.');
        $this->setHelp($this->_getHelp());

        return $this;
    }

    public function _execute(): int
    {
        if ($this->_isUninstallConfirmedByUser()) {
            $this->_getDbTearDown()->uninstall();
            $this->_getOutput()->writeln('Kōjō has been successfully uninstalled.');
            return 0;
        }

        $this->_getOutput()->writeln('Kōjō was not uninstalled.');
        return 255;
    }

    protected function _isUninstallConfirmedByUser(): bool
    {
        return $this->_getQuestionHelper()->ask($this->_getInput(), $this->_getOutput(), $this->_getQuestion());
    }

    protected function _getQuestionHelper(): QuestionHelper
    {
        return $this->getHelper('question');
    }

    protected function _getQuestion(): Question
    {
        if ($this->_question === null) {
            $question = new Question($this->_getQuestionMessage(), false);
            $question->setValidator($this->_getValidator());
            $this->_question = $question;
        }

        return $this->_question;
    }

    protected function _getValidator(): callable
    {
        $validator = function (string $answer): bool {
            $confirmedByUser = Uninstall::ANSWER_DELETE_CONFIRMED_BY_USER;
            if (!($confirmedByUser === $answer || Uninstall::ANSWER_DELETE_DECLINED_BY_USER === $answer)) {
                throw new \RuntimeException('Please type either "delete" or "no" to proceed.');
            }

            return ($answer === $confirmedByUser);
        };

        return $validator;
    }

    protected function _getQuestionMessage(): string
    {
        return <<<'EOD'
<fg=white;bg=red>                                                                     </>
<fg=white;bg=red>                           !!! WARNING !!!                           </>
<fg=white;bg=red>                                                                     </>
<fg=white;bg=red>    THIS ACTION WILL PERMANENTLY DELETE ALL OF YOUR KŌJŌ DATA!!!     </>
<fg=white;bg=red>                                                                     </>
<fg=white;bg=red>    THIS ACTION CANNOT BE UNDONE!                                    </>
<fg=white;bg=red>                                                                     </>
<fg=red>Do you want to permanently delete ALL of your Kōjō data?(delete | no) </> 
EOD;
    }

    protected function _getHelp(): string
    {
        return <<<'EOD'
<fg=white;bg=red>WARNING!!! THIS WILL DELETE ALL KŌJŌ DATA IN PERSISTENT STORAGE!</>

This command UNINSTALLS a Kōjō cluster from a persistent storage engine.
Currently only \PDO compatible storage engines are supported.
The client's Bootstrap class will be called prior to setup, and that \PDO class will be used for setup. 
EOD;
    }
}
