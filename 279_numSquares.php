<?php

class Solution
{

    /**
     * @param Integer $n
     * @return Integer
     */
    var $map;

    function numSquares($n)
    {
        if ($n == 0) {
            return 0;
        }
        $this->map = array();
        // 应该使用动态规划
        // 或者递归树?
        return $this->solve($n);
    }

    function solve($n)
    {
        if ($n < 4) {
            return $n;
        }
        if (array_key_exists($n, $this->map)) {
            return $this->map[$n];
        }
        // 改变
        $a = (int)sqrt($n);
        $min_ = PHP_INT_MAX;
        for ($i = $a; $i > 0; $i--) {
            $min_ = min($this->solve($n - pow($i, 2)), $min_);
        }
        $this->map[$n] = $min_ + 1;
        return $min_ + 1;
    }
}

$solution = new Solution();
$solution->numSquares(1);