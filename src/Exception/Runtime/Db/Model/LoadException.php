<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Exception\Runtime\Db\Model;

use Neighborhoods\Pylon\Exception\Runtime\Exception;

class LoadException extends Exception
{
    const CODE_PREFIX         = self::class . '-';
    const CODE_NO_DATA_LOADED = self::CODE_PREFIX . 'no_data_loaded';

    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->_addPossibleMessage(self::CODE_NO_DATA_LOADED, 'No data was loaded.');

        return parent::__construct($message, $code, $previous);
    }
}