<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Status;

interface TypeInterface
{
    public const TABLE_NAME = 'kojo_status_type';
    public const FIELD_NAME_ID = 'kojo_status_type_id';
    public const FIELD_NAME_NAME = 'name';
    public const INDEX_NAME_CODE = 'CODE';
    public const FIELD_NAME_CODE = 'code';
}