<?php

namespace Neighborhoods\Kojo\Api\V1\RDBMS\Connection\Service;

use Neighborhoods\Kojo\Api\V1\RDBMS\Connection\ServiceInterface;

trait AwareTrait
{
    protected $ApiV1RDBMSConnectionService = null;

    public function setApiV1RDBMSConnectionService(ServiceInterface $ApiV1RDBMSConnectionService): self
    {
        if ($this->hasApiV1RDBMSConnectionService()) {
            throw new \LogicException('ApiV1RDBMSConnectionService is already set.');
        }
        $this->ApiV1RDBMSConnectionService = $ApiV1RDBMSConnectionService;

        return $this;
    }

    protected function getApiV1RDBMSConnectionService(): ServiceInterface
    {
        if (!$this->hasApiV1RDBMSConnectionService()) {
            throw new \LogicException('ApiV1RDBMSConnectionService is not set.');
        }

        return $this->ApiV1RDBMSConnectionService;
    }

    protected function hasApiV1RDBMSConnectionService(): bool
    {
        return isset($this->ApiV1RDBMSConnectionService);
    }

    protected function unsetApiV1RDBMSConnectionService(): self
    {
        if (!$this->hasApiV1RDBMSConnectionService()) {
            throw new \LogicException('ApiV1RDBMSConnectionService is not set.');
        }
        unset($this->ApiV1RDBMSConnectionService);

        return $this;
    }
}
