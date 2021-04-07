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
        // 假如不是变换后的序列,则应该为二分查找
        // 另类的二分查找?
        // 判断当前是在大序列还是在小序列中
        // 先寻找分割点?
        $left = 0;
        $size = count($nums);
        $right = $size - 1;
        if ($target == $nums[0] || $target == $nums[$right]) {
            return true;
        }
        while ($nums[$left] == $nums[$right] && $left < $right) {
            $left++;
        }
        $pivotL = $nums[$left];
        $pivotR = $nums[$right];
        if ($target == $pivotL || $target == $pivotR) {
            return true;
        }
        $flag = $target > $pivotL;
        while ($left < $right) {
            $mid = $left + (int)ceil(($right - $left) / 2);
            if ($nums[$mid] > $target) {
                // 中点比target大,向前收缩
                if ($flag || $nums[$mid] < $pivotL) {
                    // 如果$target在前面的序列
                    $right = $mid - 1;
                } else {
                    // 如果$target在后面的序列
                    $left = $mid + 1;
                }
            } else if ($nums[$mid] < $target) {
                // 中点比target小,向后收缩
                if (!$flag || $nums[$mid] >= $pivotL) {
                    // 目标在后面的序列中
                    // 如果$target在后面的序列
                    $left = $mid + 1;
                } else {
                    // 目标在前面的序列中且当前mid在前面的序列内
                    $right = $mid - 1;
                }
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