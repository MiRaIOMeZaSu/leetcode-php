<?php

class Solution
{

    /**
     * @param Integer $n
     * @return Boolean
     */
    function isUgly($n)
    {
        if ($n < 1) {
            return false;
        }
        $nums = [2, 3, 5];
        for ($i = 0; $i < count($nums); $i++) {
            $num = $nums[$i];
            while ($n % $num == 0) {
                $toDiv = $num;
                while ($n % $toDiv == 0) {
                    $n /= $toDiv;
                    $toDiv *= $toDiv;
                }
            }
        }
        if ($n == 1) {
            return true;
        }else{
            return false;
        }
    }
}

$solution = new Solution();
$solution->isUgly(14);