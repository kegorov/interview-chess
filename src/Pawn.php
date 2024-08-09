<?php

class Pawn extends Figure
{
    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    /**
     * Method validates whether the Pawn's movements conform to the rules of chess
     *
     * @param string $xFrom   x coordinate of the figure's cell
     * @param int    $yFrom   y coordinate of the figure's cell
     * @param string $xTo     x coordinate of the target cell
     * @param int    $yTo     y coordinate of the target cell
     * @param array  $figures array of figures from the board
     *
     * @return bool
     */
    public function moveIsValid(string $xFrom, int $yFrom, string $xTo, int $yTo, array $figures) : bool
    {
        // определяем, каков цвет фигуры на клетке "To", или же возвращаем null если клетка пуста
        $capturingFigureColor = isset($figures[$xTo][$yTo]) ? $figures[$xTo][$yTo]->getIsBlack() : null;

        //определяем, пуста ли клетка перед пешкой
        if ($this->isBlack) {
            $isEmptyNextTo = !isset($figures[$xFrom][$yFrom - 1]);
        } else {
            $isEmptyNextTo = !isset($figures[$xFrom][$yFrom + 1]);
        }

        //Проверяем, занята ли наша клетка "To" противником
        $isOpponent = !$this->isBlack === $capturingFigureColor;
        //Проверяем, пустая ли наша "To" клетка
        $isEmpty = $capturingFigureColor === null;

        // Вычисляем значение, на сколько переместилась пешка по x и y
        $xMove = ord($xTo) - ord($xFrom);
        $yMove = $yTo - $yFrom;

        // Проверяем, не идет ли пешка задом наперед.
        // Если черная - перемещение должно быть меньше нуля, если белая - больше
        if ((($yMove > 0) && $this->isBlack) || (($yMove < 0) && !$this->isBlack)) {
            return false;
        }

        //Больше знак перемещения нам не нужен, интересует лишь его модуль.
        // Оставляем только модули $xMove и $yMove
        $xMove = abs($xMove);
        $yMove = abs($yMove);

        //Проверяем случаи, если клетка, на котору мы хотим переместиться, пуста
        if ($isEmpty) {
            //Смотрим различные случаи перемещения по оси y.
            //Перемещаться пешка может либо на 1, либо на 2 клетки вперед. Остальное отсекаем.
            //По оси OX перемещения в этом случае быть не может
            if (!$xMove) {
                switch ($yMove) {
                case 1:
                    //Если мы просто сходили на клетку вперед и она свободна - нет проблем
                    return true;
                case 2:
                    //Если у пешки первый ход - то она может сходить на 2 клетки. Но важно, чтобы это был именно её первый ряд
                    //И чтобы перед пешкой не было фигуры
                    if (((($yFrom == 7) && $this->isBlack) || (($yFrom == 2) && !$this->isBlack)) && $isEmptyNextTo) {
                        return true;
                    }
                    return false;
                }
            }
        } //рассмотрим случаи взятия - клетка, куда мы хотим поставить пешку, занята фигурой противника
        elseif ($isOpponent) {
            //Если фигура противника через 1 клетку наискосок, мы перемещаемся на её место
            if (($xMove == 1) && ($yMove == 1)) {
                return true;
            }
        }
            return false;
    }
}
