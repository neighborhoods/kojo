<?php

namespace Neighborhoods\Kojo\Notification;

interface BuilderInterface
{

    public function build() : \Neighborhoods\Kojo\NotificationInterface;
    public function setRecord(array $record) : \Neighborhoods\Kojo\Notification\BuilderInterface;

}

