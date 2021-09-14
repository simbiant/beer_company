<?php

namespace App\Adapter;

class SquareAreaAdapter implements ISquare
{
    /**
     * @var SquareAreaLib
     */
    protected $squareAreaLib;

    public function __construct(SquareAreaLib $squareAreaLib)
    {
        $this->squareAreaLib = $squareAreaLib;
    }

    public function squareArea(int $sideSquare)
    {
        $diagonal = $sideSquare * sqrt(2);
        return $this->squareAreaLib->getSquareArea($diagonal);
    }
}
