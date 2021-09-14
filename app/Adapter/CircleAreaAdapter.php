<?php

namespace App\Adapter;

class CircleAreaAdapter implements ICircle
{
    /**
     * @var CircleAreaLib
     */
    protected $circleAreaLib;

    public function __construct(CircleAreaLib $circleAreaLib)
    {
        $this->circleAreaLib = $circleAreaLib;
    }

    public function circleArea(int $circumference)
    {
        $diagonal = $circumference / M_PI;
        return $this->circleAreaLib->getCircleArea($diagonal);
    }
}
