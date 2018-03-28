<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data;

use Neighborhoods\Kojo\Db\Model;

class Status extends Model implements StatusInterface
{
    const TABLE_NAME                         = 'kojo_status';
    const FIELD_NAME_ID                      = 'kojo_status_id';
    const FIELD_NAME_STARTED_AT_DATE_TIME    = 'started_at_date_time';
    const FIELD_NAME_STARTED_AT_MICRO_TIME   = 'started_at_micro_time';
    const FIELD_NAME_FINALIZED_AT_DATE_TIME  = 'finalized_at_date_time';
    const FIELD_NAME_FINALIZED_AT_MICRO_TIME = 'finalized_at_micro_time';
    const FIELD_NAME_TYPE_CODE               = 'type_code';
    const FIELD_NAME_STATE                   = 'state';
    const FIELD_NAME_MESSAGE_COUNT           = 'message_count';
    const FIELD_NAME_ERROR_COUNT             = 'error_count';
    const FIELD_NAME_MAX_ERROR_LEVEL         = 'max_error_level';
    const INDEX_NAME_TYPE_CODE               = 'TYPE_CODE';
    const FOREIGN_KEY_NAME                   = 'TYPE_CODE';
}