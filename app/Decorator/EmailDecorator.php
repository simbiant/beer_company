<?php

namespace App\Decorator;

class EmailDecorator extends NotifyDecorator
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
