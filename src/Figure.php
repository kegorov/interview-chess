<?php

class Figure {
    protected $isBlack;

    public function __construct($isBlack) {
        $this->isBlack = $isBlack;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString() {
        throw new \Exception("Not implemented");
    }
    
    public function getIsBlack()
    {
        return $this->isBlack;
    }

    /**
     * Method validates whether figure's movements conform to the rules of chess
     *
     * @param string $xFrom - x coordinate of the figure's cell
     * @param int $yFrom - y coordinate of the figure's cell
     * @param string $xTo - x coordinate of the target cell
     * @param int $yTo - y coordinate of the target cell
     * @param array $figures - array of figures from the board
     * @return bool
     */
    public function moveIsValid(string $xFrom, int $yFrom, string $xTo, int $yTo, array $figures) : bool
    {
        return true;
    }
    
}
