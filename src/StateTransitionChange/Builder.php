<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

use Neighborhoods\Kojo\StateTransitionChangeInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use Data\Builder\Factory\AwareTrait;

    /** @var array */
    protected $record;

    public function build() : StateTransitionChangeInterface
    {
        $stateTransitionChange = $this->getStateTransitionChangeFactory()->create();
        $record = $this->getRecord();

        $stateTransitionChange->setId((int)$record[StateTransitionChangeInterface::PROP_ID]);
        $stateTransitionChange->setData(
            $this
                ->getStateTransitionChangeDataBuilderFactory()
                ->create()
                ->setRecord($record[StateTransitionChangeInterface::PROP_DATA])
                ->build()
        );

        return $stateTransitionChange;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}
