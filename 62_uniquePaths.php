<?php

class Solution
{

    /**
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n)
    {
        // 使用回溯法(过慢
        // 应该使用动态规划
        // 右下角
        /*
        if ($m < 1 || $n < 1) {
            return 0;
        }
        if ($m == 1 && $n == 1) {
            return 1;
        }
        return $this->uniquePaths($m - 1, $n) + $this->uniquePaths($m, $n - 1);
        */
        $dp = array();
        $i = 0;
        for (; $i < $m - 1; $i++) {
            $temp = array();
            array_push($dp, $temp);
            for ($j = 0; $j < $n - 1; $j++) {
                array_push($dp[$i], 0);
            }
            array_push($dp[$i], 1);
        }
        $temp = array();
        array_push($dp, $temp);
        for ($j = 0; $j < $n; $j++) {
            array_push($dp[$i], 1);
        }
        for ($i = $m - 2; $i >= 0; $i--) {
            for ($j = $n - 2; $j >= 0; $j--) {
                $dp[$i][$j] = $dp[$i + 1][$j] + $dp[$i][$j + 1];
            }
        }
        return $dp[0][0];
    }
}

$solution = new Solution();
$solution->uniquePaths(1, 1);