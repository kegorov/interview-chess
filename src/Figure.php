<?php

class Figure
{
    protected $isBlack;

    public function __construct($isBlack)
    {
        $this->isBlack = $isBlack;
    }

    public function isBlack()
    {
        return $this->isBlack;
    }

    public function isCorrectMove($xFrom, $yFrom, $xTo, $yTo, $board): bool
    {
        return true;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString()
    {
        throw new \Exception("Not implemented");
    }
}
