<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function findMin($nums)
    {
        // 实际上寻找旋转结点
        // 旋转了1-n次
        $size = count($nums);
        $pivot = $nums[$size - 1];
        $left = 0;
        $right = $size - 1;
        if ($nums[0] < $pivot) {
            return $nums[0];
        }
        while ($left < $right) {
            $mid = $left + (int)floor(($right - $left) / 2);
            if ($nums[$mid] > $pivot) {
                $left = $mid + 1;
            } else {
                $right = $mid;
            }
        }
        $min = PHP_INT_MAX;
        if ($right > 0) {
            $min = min($min, $nums[$right]);
        }
        if ($left < $size) {
            $min = min($min, $nums[$left]);
        }
        return $min;
    }
}

$solution = new Solution();
$arr = [8, 1, 2, 3, 4, 5, 6, 7];
$solution->findMin($arr);