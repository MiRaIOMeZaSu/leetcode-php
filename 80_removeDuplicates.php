<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function removeDuplicates(&$nums)
    {
        if (count($nums) < 3) {
            return count($nums);
        }
        $ret = 0;
        $index = 1;
        $num = 1;
        $last = $nums[0];
        while ($index < count($nums)) {
            if ($nums[$index] == $last) {
                $num++;
                $ret++;
                $nums[$ret] = $nums[$index];
                if ($num >= 2) {
                    while ($index < count($nums) && $last == $nums[$index]) {
                        $index++;
                    }
                    if ($index < count($nums)) {
                        $num = 1;
                        $ret++;
                        $nums[$ret] = $nums[$index];
                    } else {
                        $num = 0;
                        $nums[$ret] = $last;
                        break;
                    }
                }
            }else{
                $num = 1;
                $ret++;
                $nums[$ret] = $nums[$index];
            }
            $last = $nums[$index];
            $index++;
        }
        $ret += 1;
        return $ret;
    }
}

$solution = new Solution();
$arr = [1,1,1];
$solution->removeDuplicates($arr);