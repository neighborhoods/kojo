<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Exception\Runtime\Db\Model;

use Neighborhoods\Kojo\Runtime\Exception;

class LoadException extends Exception
{
    const CODE_NO_DATA_LOADED = self::CODE_PREFIX . 'no_data_loaded';
    const CODE_MULTIPLE_RECORDS_RETRIEVED = self::CODE_PREFIX . 'multiple_records_retrieved';

    public function __construct()
    {
        parent::__construct();

        $this->addPossibleMessage(self::CODE_NO_DATA_LOADED, 'No data was loaded.');
        $this->addPossibleMessage(self::CODE_MULTIPLE_RECORDS_RETRIEVED, 'Multiple records retrieved.');

        return $this;
    }
}
