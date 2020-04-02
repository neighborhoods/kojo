<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Neighborhoods\Kojo\Process\Pool\Logger\Message;

interface DataInterface extends \JsonSerializable
{
    public const PROP_OLD_STATE = 'old_state';
    public const PROP_NEW_STATE = 'new_state';
    public const PROP_TIMESTAMP = 'timestamp';
    public const PROP_METADATA = 'metadata';

    public function getOldState() : string;
    public function setOldState(string $old_state) : DataInterface;

    public function getNewState() : string;
    public function setNewState(string $new_state) : DataInterface;

    public function getTimestamp() : \DateTimeInterface;
    public function setTimestamp(\DateTimeInterface $timestamp) : DataInterface;

    public function getMetadata() : Message\MetadataInterface;
    public function setMetadata(Message\MetadataInterface $metadata) : DataInterface;
}
