<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

interface DataInterface
{
    public const PROP_OLD_STATE = 'old_state';
    public const PROP_NEW_STATE = 'new_state';
    public const PROP_TIMESTAMP = 'timestamp';
    // public const PROP_METADATA = 'metadata';

    public function getOldState() : string;
    public function setOldState(string $old_state) : DataInterface;

    public function getNewState() : string;
    public function setNewState(string $new_state) : DataInterface;

    public function getTimestamp() : \DateTimeInterface;
    public function setTimestamp(\DateTimeInterface $timestamp) : DataInterface;
}
