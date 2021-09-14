<?php

namespace App\Decorator;

interface INotify
{
    /**
     * @param string $message
     * @return mixed
     */
    public function send(string $message);
}
