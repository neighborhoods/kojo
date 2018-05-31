<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Status;

interface MessageInterface
{

    public const FIELD_NAME_LEVEL = 'level';
    public const TABLE_NAME = 'kojo_status_message';
    public const FIELD_NAME_ID = 'kojo_status_message_id';
    public const FIELD_NAME_MICRO_TIME = 'micro_time';
    public const FIELD_NAME_STATUS_ID = 'kojo_status_id';
    public const INDEX_NAME_STATUS_ID = 'STATUS_ID';
    public const FIELD_NAME_MESSAGE = 'message';
    public const FIELD_NAME_DATE_TIME = 'date_time';
    public const FOREIGN_KEY_NAME_STATUS_ID = 'STATUS_ID';
}