<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $x
     * @return Integer
     */
    var $ret;
    var $nums;
    var $size;

    function minOperations($nums, $x)
    {
        // 使用回溯法
        // 在操作数大于已有最小值时及时剪枝
        // 小于零时剪枝
        $this->size = count($nums);
        $this->nums = &$nums;
        $this->ret = PHP_INT_MAX;
        $this->solve(0, $this->size - 1, $x);
        return $this->ret != PHP_INT_MAX ? $this->ret : -1;
    }

    function solve($left, $right, $rest)
    {
        if ($rest < 0) {
            return;
        } else if ($rest > $this->ret) {
            return;
        } else if ($rest == 0) {
            $this->ret = min($left + ($this->size - 1 - $right), $this->ret);
        }
        if ($left <= $right) {
            $this->solve($left, $right - 1, $rest - $this->nums[$right]);
            $this->solve($left + 1, $right, $rest - $this->nums[$left]);
        }
    }
}

$solution = new Solution();
$arr = [3, 2, 20, 1, 1, 3];
$solution->minOperations($arr, 10);