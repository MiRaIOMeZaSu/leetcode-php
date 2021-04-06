<?php

class Solution
{

    /**
     * @param Integer $n
     * @param Integer[][] $dependencies
     * @param Integer $k
     * @return Integer
     */
    function minNumberOfSemesters($n, $dependencies, $k)
    {
        // 层次遍历
        $out = array();
        $in = array();
//        $set = array();
        for ($i = 0; $i < count($dependencies); $i++) {
            $a = $dependencies[$i][1];
            $b = $dependencies[$i][0];
            if (!in_array($b, $in)) {
                array_push($in, $b);
            }
            if (!array_key_exists($a, $out)) {
                $out[$a] = array();
            }
            array_push($out[$a], $b);
        }
        $base = array();
        $ret = 0;
        for ($i = 1; $i <= $n; $i++) {
            if (!in_array($i, $in)) {
                array_push($base, $i);
            }
        }
        $ret += (int)ceil(count($base) / $k);
        while (count($base) != 0) {
            $temp = array();
            for ($i = 0; $i < count($base); $i++) {
                if(array_key_exists($base[$i],$out)){
                    for ($j = 0; $j < count($out[$base[$i]]); $j++) {
                        array_push($temp, $out[$base[$i]][$j]);
                    }
                }
            }
            $base = $temp;
            $ret += (int)ceil(count($base) / $k);
        }
        return $ret;
    }
}

$solution = new Solution();
$arr = [[2,1],[2,4]];
$solution->minNumberOfSemesters(4, $arr, 2);