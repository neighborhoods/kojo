<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message;

use LogicException;
use Monolog\Formatter\NormalizerFormatter;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Process\Pool\Logger\MessageInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Time;
use Throwable;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use SerializableProcess\FromProcessModel\Builder\Factory\AwareTrait;
    use \Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Builder\AwareTrait;
    use Time\AwareTrait;

    public const CONTEXT_KEY_EXCEPTION = 'exception';
    protected const LOG_DATE_TIME_FORMAT = 'D, d M y H:i:s.u T';
    // docker doesn't handle >16KB stdout lines very well, this limits the
    // length of the the `message` and `context.exception.message` values,
    // leaving a buffer for the rest of the line
    protected const MAX_MESSAGE_LENGTH = 6000;

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
    /** @var MetadataInterface */
    protected $metadata;

    public function build() : MessageInterface
    {
        $logMessage = $this->getProcessPoolLoggerMessageFactory()->create();

        $referenceTime = $this->_getTime()->getNow();
        $logMessage->setTime($referenceTime->format(self::LOG_DATE_TIME_FORMAT));
        $logMessage->setLevel($this->getLevel());
        $context = $this->getContext();

        $actualMessage = $this->getMessage();
        $truncatedMessage = substr($actualMessage, 0, self::MAX_MESSAGE_LENGTH);
        $logMessage->setMessage($truncatedMessage);

        if (
            array_key_exists(self::CONTEXT_KEY_EXCEPTION, $context) &&
            $context[self::CONTEXT_KEY_EXCEPTION]
            instanceof Throwable
        ) {
            $normalizedException = (new NormalizerFormatter())->format([$context[self::CONTEXT_KEY_EXCEPTION]]);
            unset($context[self::CONTEXT_KEY_EXCEPTION]);

            $exceptionMessage = $normalizedException[0]['message'];
            $truncatedExceptionMessage = substr($exceptionMessage, 0, self::MAX_MESSAGE_LENGTH);
            $normalizedException[0]['message'] = $truncatedExceptionMessage;

            $context[self::CONTEXT_KEY_EXCEPTION] = $normalizedException[0];
        }

        if (json_encode($context) === false) {
            $logMessage->setContext([]);
        } else {
            $logMessage->setContext($context);
        }

        $logMessage->setContextJsonLastError(json_last_error());

        $metadata = $this->getProcessPoolLoggerMessageMetadataBuilder()->build();
        $logMessage->setMetadata($metadata);

        if ($metadata->hasJob()) {
            $logMessage->setKojoJob($metadata->getJob());
        }

        if ($metadata->hasProcess()) {
            $logMessage->setKojoProcess($metadata->getProcess());
            $logMessage->setProcessId($metadata->getProcess()->getProcessId());
            $logMessage->setProcessPath($metadata->getProcess()->getPath());
        }

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

    public function getMetadata() : MetadataInterface
    {
        if ($this->metadata === null) {
            throw new \LogicException('Builder metadata has not been set.');
        }

        return $this->metadata;
    }

    public function setMetadata(MetadataInterface $metadata) : BuilderInterface
    {
        if ($this->metadata !== null) {
            throw new \LogicException('Builder metadata is already set.');
        }

        $this->metadata = $metadata;

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
