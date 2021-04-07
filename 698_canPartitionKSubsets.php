<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Boolean
     */
    var $size;
    var $list;
    var $pivot;

    function canPartitionKSubsets($nums, $k)
    {
        // 使用压状动态规划
        // 存在重复数字
        sort($nums);
        $this->list = $nums;
        $this->size = count($nums);
        $sum = 0;
        for ($i = 0; $i < $this->size; $i++) {
            $sum += $nums[$i];
        }
        if ($sum % $k != 0) {
            return false;
        }
        $this->pivot = $sum / $k;
        if ($nums[$this->size - 1] > $this->pivot) {
            return false;
        }
        return $this->solve(0, $this->pivot);
    }

    function solve($bit, $div)
    {
        if ($div < 0) {
            return false;
        } else if ($div == 0) {
            if ($bit == ((1 << $this->size) - 1)) {
                return true;
            }
            $div = $this->pivot;
        }
        for ($i = $this->size - 1; $i >= 0; $i--) {
            if (($bit | 1 << $i) != $bit) {
                // 未访问
                if ($this->solve($bit | 1 << $i, $div - $this->list[$i])) {
                    return true;
                }
            }
        }
        return false;
    }
}

$solution = new Solution();
$arr = [4, 3, 2, 3, 5, 2, 1];
$bool = $solution->canPartitionKSubsets($arr, 4);
echo $bool;