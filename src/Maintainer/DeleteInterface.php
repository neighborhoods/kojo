<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Maintainer;

interface DeleteInterface
{
    const SEMAPHORE_RESOURCE_NAME_MAINTAINER_DELETE = 'maintainer_delete';

    public function deleteCompletedJobs(): DeleteInterface;
}