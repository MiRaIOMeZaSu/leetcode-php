<?php

class Solution
{

    /**
     * @param Integer[] $g
     * @param Integer[] $s
     * @return Integer
     */
    function findContentChildren($g, $s)
    {
        sort($g);
        sort($s);
        $index_g = count($g) - 1;
        $index_s = count($s) - 1;
        $num = 0;
        while ($index_g >= 0 && $index_s >= 0) {
            if ($s[$index_s] >= $g[$index_g]) {
                $num++;
                $index_s--;
            }
            $index_g--;
        }
        return $num;
    }
}