<?php

namespace App\Decorator;

abstract class NotifyDecorator implements INotify
{
    protected $notify;

    public function __construct(INotify $notify)
    {
        $this->notify = $notify;
    }

    /**
     * @param string $message
     */
    public function send(string $message)
    {
        $this->notify->send($message);
    }
}
