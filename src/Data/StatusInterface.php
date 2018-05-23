<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data;

use Neighborhoods\Kojo\Db\ModelInterface;

interface StatusInterface extends ModelInterface
{
    public const TABLE_NAME = 'kojo_status';
    public const FIELD_NAME_MAX_ERROR_LEVEL = 'max_error_level';
    public const FIELD_NAME_ERROR_COUNT = 'error_count';
    public const FIELD_NAME_FINALIZED_AT_MICRO_TIME = 'finalized_at_micro_time';
    public const FOREIGN_KEY_NAME = 'TYPE_CODE';
    public const FIELD_NAME_STATE = 'state';
    public const FIELD_NAME_FINALIZED_AT_DATE_TIME = 'finalized_at_date_time';
    public const FIELD_NAME_ID = 'kojo_status_id';
    public const FIELD_NAME_TYPE_CODE = 'type_code';
    public const INDEX_NAME_TYPE_CODE = 'TYPE_CODE';
    public const FIELD_NAME_STARTED_AT_DATE_TIME = 'started_at_date_time';
    public const FIELD_NAME_STARTED_AT_MICRO_TIME = 'started_at_micro_time';
    public const FIELD_NAME_MESSAGE_COUNT = 'message_count';
}