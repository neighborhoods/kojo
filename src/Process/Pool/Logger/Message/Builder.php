<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use LogicException;
use Throwable;
use Monolog\Formatter\NormalizerFormatter;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\MessageInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Time;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use SerializableProcess\FromProcessModel\Builder\Factory\AwareTrait;
    use Time\AwareTrait;

    public const CONTEXT_KEY_EXCEPTION = 'exception';
    protected const LOG_DATE_TIME_FORMAT = 'D, d M y H:i:s.u T';

    /** @var ProcessInterface */
    protected $process;
    /** @var JobInterface */
    protected $job;
    /** @var string */
    protected $level;
    /** @var string */
    protected $message;
    /** @var array */
    protected $context;

    public function build() : MessageInterface
    {
        $logMessage = $this->getProcessPoolLoggerMessageFactory()->create();
        if ($this->hasProcess()) {
            $processId = (string)$this->getProcess()->getProcessId();
            $serializableProcess = $this->getProcessPoolLoggerMessageSerializableProcessFromProcessModelBuilderFactory()
                ->create()
                ->setProcessModelInterface($this->getProcess())
                ->build();
            $logMessage->setKojoProcess($serializableProcess);

        } else {
            $processId = '?';
        }

        $referenceTime = $this->_getTime()->getNow();
        $logMessage->setTime($referenceTime->format(self::LOG_DATE_TIME_FORMAT));
        $logMessage->setLevel($this->getLevel());
        $logMessage->setProcessId($processId);
        $logMessage->setProcessPath($this->getProcess()->getPath());

        if ($this->hasJob()) {
            $logMessage->setKojoJob($this->getJob());
        }

        $logMessage->setMessage($this->getMessage());
        $context = $this->getContext();

        if (
            array_key_exists(self::CONTEXT_KEY_EXCEPTION, $context) &&
            $context[self::CONTEXT_KEY_EXCEPTION]
            instanceof Throwable
        ) {
            $normalizedException = (new NormalizerFormatter())->format([$context[self::CONTEXT_KEY_EXCEPTION]]);
            unset($context[self::CONTEXT_KEY_EXCEPTION]);
            $context[self::CONTEXT_KEY_EXCEPTION] = $normalizedException[0];
        }

        if (json_encode($context) === false) {
            $logMessage->setContext([]);
        } else {
            $logMessage->setContext($context);
        }

        $logMessage->setContextJsonLastError(json_last_error());

        return $logMessage;
    }

    public function getLevel() : string
    {
        if ($this->level === null) {
            throw new LogicException('Builder level has not been set.');
        }

        return $this->level;
    }

    public function setLevel(string $level) : BuilderInterface
    {
        if ($this->level !== null) {
            throw new LogicException('Builder level is already set.');
        }

        $this->level = $level;

        return $this;
    }

    public function getMessage() : string
    {
        if ($this->message === null) {
            throw new LogicException('Builder message has not been set.');
        }

        return $this->message;
    }

    public function setMessage(string $message) : BuilderInterface
    {
        if ($this->message !== null) {
            throw new LogicException('Builder message is already set.');
        }

        $this->message = $message;

        return $this;
    }

    public function getContext() : array
    {
        if ($this->context === null) {
            throw new LogicException('Builder context has not been set.');
        }

        return $this->context;
    }

    public function setContext(array $context) : BuilderInterface
    {
        if ($this->context !== null) {
            throw new LogicException('Builder context is already set.');
        }

        $this->context = $context;

        return $this;
    }

    protected function getProcess() : ProcessInterface
    {
        if ($this->process === null) {
            throw new LogicException('Builder process has not been set.');
        }

        return $this->process;
    }

    public function setProcess(ProcessInterface $process) : BuilderInterface
    {
        if ($this->process !== null) {
            throw new LogicException('Builder process is already set.');
        }

        $this->process = $process;

        return $this;
    }

    public function hasProcess() : bool
    {
        return isset($this->process);
    }

    protected function getJob() : JobInterface
    {
        if ($this->job === null) {
            throw new LogicException('Builder job has not been set.');
        }

        return $this->job;
    }

    public function setJob(JobInterface $job) : BuilderInterface
    {
        if ($this->job !== null) {
            throw new LogicException('Builder job is already set.');
        }

        $this->job = $job;

        return $this;
    }

    public function hasJob() : bool
    {
        return isset($this->job);
    }
}
