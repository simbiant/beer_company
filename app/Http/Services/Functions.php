<?php

namespace App\Http\Services;

use Illuminate\Routing\Controller as BaseController;

class Functions extends BaseController
{
    public function getSimple(int $number): int
    {
        $result = $number % 2 ? 1 : 2;

        while (!($number % 2)) {
            $number /= 2;
        }

        for ($i = 3; $i*$i< $number; $i+=2) {
            for (; !($number % $i); $number /= $i) {
                $result = $i;
            }
        }

        return $result > $number ? $result : $number;
    }
}
