<?php

namespace App\Adapter;

class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
        return (M_PI * $diagonal**2) / 4;
   }
}
