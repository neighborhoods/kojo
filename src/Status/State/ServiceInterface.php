<?php
declare(strict_types=1);

namespace NHDS\Jobs\Status\State;

interface ServiceInterface
{
    const STATE_OPEN_MESSAGES       = 'open_messages';
    const STATE_OPEN                = 'open';
    const STATE_COMPLETE_ERRORS     = 'complete_errors';
    const STATE_OPEN_ERRORS         = 'open_errors';
    const STATE_COMPLETE_SUCCESSFUL = 'complete_successful';
}