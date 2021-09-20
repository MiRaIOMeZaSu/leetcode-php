<?php

class Solution
{

    /**
     * @param Integer $K
     * @return Integer
     */
    function smallestRepunitDivByK($K)
    {
        if ($K % 2 == 0) {
            return -1;
        }
        if ($K == 1) {
            return 1;
        }
        $num = 1;
        $len = 1;
        $arr = array();
        while (true) {
            if ($num % $K == 0) {
                return $len;
            }
            if ($num > $K) {
                $num = $num % $K;
            }
            if (in_array($num, $arr)) {
                return -1;
            } else {
                array_push($arr, $num);
            }
            $num = $num * 10 + 1;
            $len++;
        }
        return $len;
    }
}

$solution = new Solution();
$solution->smallestRepunitDivByK(9995);
