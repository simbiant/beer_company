<?php

namespace App\Strategy;

use App\Models\Sock;
use App\Models\User;

class YandexPaymentSystem implements IPaymentSystem
{
    public function system(Sock $sock, User $user) {
        $stripe = new \Stripe\StripeClient("sk_test_51Jb1BPSD9upyzS8WvbzSjdNW153jYVBtpCRMmVRILGYUBxXz254kVhq7mhgiQfaX63rZTN88FaT7A5ZpY7C2hCSI00aImdha3m");
        $ch = $stripe->yandexPay->capture(
            'YANDEX',
            [$sock->price, $user->id],
            ['api_key' => 'sk_test_51Jb1BPSD9upyzS8WvbzSjdNW153jYVBtpCRMmVRILGYUBxXz254kVhq7mhgiQfaX63rZTN88FaT7A5ZpY7C2hCSI00aImdha3m']
        );

        return $ch->status;
    }
}
