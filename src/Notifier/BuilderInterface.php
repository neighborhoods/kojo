<?php

namespace Neighborhoods\Kojo\Notifier;

interface BuilderInterface
{

    public function build() : \Neighborhoods\Kojo\NotifierInterface;
    public function setRecord(array $record) : \Neighborhoods\Kojo\Notifier\BuilderInterface;

}

