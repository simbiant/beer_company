<?php

namespace App\Decorator;

class SMSDecorator extends NotifyDecorator
{
    /**
     * @param string $message
     * @return mixed
     */
    public function send(string $message)
    {
        $this->notify->send($message);
    }
}
