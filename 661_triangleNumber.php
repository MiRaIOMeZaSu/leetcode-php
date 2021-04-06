<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function triangleNumber($nums)
    {
        // 以两个为一对
        // 先统计数量 x - 因为会有相同边(可以当做特殊情况
        $ret = 0;
        sort($nums);
        $a = 0;
        while ($a < count($nums) - 2) {
            $b = $a + 1;
            while ($b < count($nums) - 1) {
                $c = $b + 1;
                $pivotSum = $nums[$a] + $nums[$b];
                while ($c < count($nums)) {
                    if ($nums[$c] < $pivotSum) {
                        // 此处可以直接使用二分查找,且上次的查找结果可以用在下一次
                        $ret += 1;
                    } else {
                        break;
                    }
                    $c++;
                }
                $b++;
            }
            $a++;
        }
        // 开始考虑重复边
        return $ret;
    }
}

$solution = new Solution();
$arr = [2, 2, 3, 4];
$solution->triangleNumber($arr);