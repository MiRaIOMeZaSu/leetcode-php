<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums)
    {
        // 以0为pivot进行一次部分快排即可
        $size = count($nums);
        $_0 = 0;
        $_2 = $size - 1;
        $index = 0;
        while ($index <= $_2 && $_0 <= $_2) {
            while ($nums[$_0] == 0 && $_0 <= $_2) {
                $index++;
                $_0++;
            }
            while ($nums[$_2] == 2 && $_2 >= 0) {
                $_2--;
            }
            if ($_2 < 0 || $_0 > $_2) {
                break;
            }
            if ($index >= 0 && $index <= $_2) {
                if ($nums[$index] == 0) {
                    $temp = $nums[$_0];
                    $nums[$_0] = 0;
                    $nums[$index] = $temp;
                    $_0++;
                    continue;
                } else if ($nums[$index] == 2) {
                    $temp = $nums[$_2];
                    $nums[$_2] = 2;
                    $nums[$index] = $temp;
                    $_2--;
                    continue;
                }
                $index++;
            } else {
                break;
            }
        }
    }
}

$solution = new Solution();
$arr = [0, 0];
$solution->sortColors($arr);