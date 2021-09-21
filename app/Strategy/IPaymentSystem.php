<?php

namespace App\Strategy;

use App\Models\Sock;
use App\Models\User;

interface IPaymentSystem
{
    public function system(Sock $sock, User $user);
}
