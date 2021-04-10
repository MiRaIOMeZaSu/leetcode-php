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
        // 进和退
        $this->ret = PHP_INT_MAX;
        $this->size = count($nums);
        $left = 0;
        $right = $this->size - 1;
        $num = 0;
        while ($left <= $right && $num < $x) {
            $num += $nums[$left];
            $left++;
        }
        if ($num == $x) {
            $this->ret = min($left + ($this->size - 1 - $right), $this->ret);
        }
        $num -= $nums[$left - 1];
        $left--;
        if ($left <= $right) {
            while ($left <= $right && $num < $x) {
                $num += $nums[$right];
                $right--;
                while ($num > $x && $left >= 0) {
                    $num -= $nums[$left - 1];
                    $left--;
                }
                if ($num == $x) {
                    $this->ret = min($left + ($this->size - 1 - $right), $this->ret);
                    $num -= $nums[$left - 1];
                    $left--;
                }
            }
        } else {
            return -1;
        }
        return $this->ret != PHP_INT_MAX ? $this->ret : -1;
    }
}

$solution = new Solution();
$arr = [1, 1, 4, 2, 3];
$ret = $solution->minOperations($arr, 5);
echo $ret;