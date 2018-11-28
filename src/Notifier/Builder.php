<?php

namespace Neighborhoods\Kojo\Notifier;

class Builder implements BuilderInterface
{

    use \Neighborhoods\Kojo\Notifier\Factory\AwareTrait;

    /**
     * @var array
     */
    protected $record = null;

    public function build() : \Neighborhoods\Kojo\NotifierInterface
    {
        $Notifier =
            $this->getAskNotifierFactory()
                ->create();
        return $Notifier->setNotify($this->record['notify'])
;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : \Neighborhoods\Kojo\Notifier\BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }


}

