<?php

namespace App\Strategy;

use App\Models\Sock;
use App\Models\User;

class Payout
{
    public function pay(IPaymentSystem $paymentSystem, Sock $sock, User $user) {

        return $paymentSystem->system($sock, $user);
    }
}
