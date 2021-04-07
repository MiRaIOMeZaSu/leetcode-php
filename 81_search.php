<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Boolean
     */
    function search($nums, $target)
    {
        sort($nums);
        $size = count($nums);
        $left = 0;
        $right = $size - 1;
        while ($left < $right) {
            $mid = $left + (int)ceil(($right - $left) / 2);
            if ($target > $nums[$mid]) {
                $left = $mid + 1;
            } else if ($target < $nums[$mid]) {
                $right = $mid - 1;
            } else {
                return true;
            }
        }
        return ($target == $nums[$left] && $left < $size) || ($target == $nums[$right] && $left < $size);
    }
}

$solution = new Solution();
$arr = [4, 5, 6, 7, 0, 1, 2];
$ret = $solution->search($arr, 0);
echo $ret;