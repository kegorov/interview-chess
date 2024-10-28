<?php

class Pawn extends Figure
{

    private $firstMove = true;

    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    public function isCorrectMove($xFrom, $yFrom, $xTo, $yTo, $board): bool
    {
        // Determine direction based on pawn color
        $direction = $this->isBlack ? -1 : 1;
        $figures = $board->getFigures();

        // Check if moving forward correctly
        $verticalMove = $yTo - $yFrom === $direction || ($this->firstMove && $yTo - $yFrom === 2 * $direction);
        $this->firstMove = false;

        // Check if the move is vertical and the target square is empty
        if ($xFrom === $xTo && $verticalMove && !isset($figures[$xTo][$yTo])) {
            if ($yTo - $yFrom === 2 * $direction && isset($figures[$xFrom][$yFrom + $direction])) {
                return false;
            }
            return true;
        }

        if (abs(ord($xFrom) - ord($xTo)) === 1 && $yTo - $yFrom === $direction) {
            if (isset($figures[$xTo][$yTo]) && $figures[$xTo][$yTo]->isBlack !== $this->isBlack) {
                return true;
            }
        }

        return false;
    }
}
