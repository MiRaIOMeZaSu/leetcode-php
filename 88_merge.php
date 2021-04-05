<?php

class Solution
{

    /**
     * @param Integer[] $nums1
     * @param Integer $m
     * @param Integer[] $nums2
     * @param Integer $n
     * @return NULL
     */
    function merge(&$nums1, $m, $nums2, $n)
    {
        $length_1 = count($nums1);
        $index = $length_1 - 1;
        $m--;
        $n--;
        while ($index >= 0 && $m >= 0 && $n >= 0) {
            if ($nums1[$m] > $nums2[$n]) {
                $nums1[$index] = $nums1[$m];
                $m--;
            } else {
                $nums1[$index] = $nums2[$n];
                $n--;
            }
            $index--;
        }
        if ($m < 0) {
            while ($index >= 0) {
                $nums1[$index] = $nums2[$n];
                $n--;
                $index--;
            }
        }
    }
}