<?php

namespace Neighborhoods\Kojo\Notifier\Map;

interface BuilderInterface
{

    public function build() : \Neighborhoods\Kojo\Notifier\MapInterface;
    public function setRecords(array $record) : \Neighborhoods\Kojo\Notifier\Map\BuilderInterface;

}

