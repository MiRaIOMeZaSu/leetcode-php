<?php

class Solution
{

    /**
     * @param Integer[] $answers
     * @return Integer
     */
    function numRabbits($answers)
    {
        sort($answers);
        if (count($answers) == 1) {
            return $answers[0] + 1;
        }
        $index = 0;
        $ret = 0;
        while ($index < count($answers)) {
            if ($answers[$index] == 0) {
                $ret++;
                $index++;
            } else {
                break;
            }
        }
        $last = 0;
        $num = 1;
        while ($index < count($answers)) {
            // 此时$answers[$index]必不为零
            if ($answers[$index] == $last) {
                $num++;
                if ($num >= $answers[$index] + 1) {
                    $ret += $answers[$index] + 1;
                    $num = 0;
                    $last = 0;
                }
            } else {
                if ($last != 0) {
                    // 若上次并非是因为满了
                    $ret += $last + 1;
                }
                $num = 1;
                $last = $answers[$index];
            }
            $index++;
        }
        if ($num != 0) {
            // 若上次并非是因为满了
            $ret += $last + 1;
        }
        return $ret;
    }
}

$solution = new Solution();
$in = array(10, 10, 10);
$solution->numRabbits($in);