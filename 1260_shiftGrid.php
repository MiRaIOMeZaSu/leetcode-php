<?php

class Solution
{

    /**
     * @param Integer[][] $grid
     * @param Integer $k
     * @return Integer[][]
     */
    var $m;
    var $n;
    var $amount;

    function shiftGrid($grid, $k)
    {
        $this->m = count($grid);
        $this->n = count($grid[0]);
        $this->amount = $this->m * $this->n;
        $k = $k % $this->amount;
        $count = 0;
        $visit = array();
        for ($i = 0; $i < $this->amount; $i++) {
            array_push($visit, 0);
        }
        $index = 0;
        $toInsert = $grid[0][0];
        while ($count < $this->amount) {
            // 要移动的次数
            if ($visit[($index + $k)% $this->amount] == 1) {
                $index++;
                $temp = $this->getIndex($index);
                $toInsert = $grid[$temp[0]][$temp[1]];
                continue;
            }
            $pos_beInserted = $this->getIndex($index + $k);
            $temp = $grid[$pos_beInserted[0]][$pos_beInserted[1]];
            $grid[$pos_beInserted[0]][$pos_beInserted[1]] = $toInsert;
            $toInsert = $temp;
            $index += $k;
            $visit[$index % $this->amount] = 1;
            $count++;
        }
        return $grid;
    }

    function getIndex($index)
    {
        $ret = array();
        $index = $index % $this->amount;
        array_push($ret, (int)($index / $this->n));
        array_push($ret, $index % $this->n);
        return $ret;
    }
}

$solution = new Solution();
$arr = [[1],[2],[3],[4],[7],[6],[5]];
$solution->shiftGrid($arr, 23);