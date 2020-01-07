<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\Process\Pool\Logger\Message;

class Data implements DataInterface
{
    /** @var string */
    protected $old_state;
    /** @var string */
    protected $new_state;
    /** @var \DateTimeInterface */
    protected $timestamp;
    /** @var Message\MetadataInterface */
    protected $metadata;

    public function getOldState() : string
    {
        if ($this->old_state === null) {
            throw new \LogicException('Data old_state has not been set.');
        }
        return $this->old_state;
    }

    public function setOldState(string $old_state) : DataInterface
    {
        if ($this->old_state !== null) {
            throw new \LogicException('Data old_state is already set.');
        }
        $this->old_state = $old_state;
        return $this;
    }

    public function getNewState() : string
    {
        if ($this->new_state === null) {
            throw new \LogicException('Data new_state has not been set.');
        }
        return $this->new_state;
    }

    public function setNewState(string $new_state) : DataInterface
    {
        if ($this->new_state !== null) {
            throw new \LogicException('Data new_state is already set.');
        }
        $this->new_state = $new_state;
        return $this;
    }

    public function getTimestamp() : \DateTimeInterface
    {
        if ($this->timestamp === null) {
            throw new \LogicException('Data timestamp has not been set.');
        }
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp) : DataInterface
    {
        if ($this->timestamp !== null) {
            throw new \LogicException('Data timestamp is already set.');
        }
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getMetadata() : Message\MetadataInterface
    {
        if ($this->metadata === null) {
            throw new \LogicException('Data metadata has not been set.');
        }
        return $this->metadata;
    }

    public function setMetadata(Message\MetadataInterface $metadata) : DataInterface
    {
        if ($this->metadata !== null) {
            throw new \LogicException('Data metadata is already set.');
        }
        $this->metadata = $metadata;
        return $this;
    }
}
