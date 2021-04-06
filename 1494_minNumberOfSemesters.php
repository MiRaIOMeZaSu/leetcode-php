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
        $in = array();
        $in_count = array();
        $out_count = array();
        $out = array();
        $set = array();
        for ($i = 0; $i < count($dependencies); $i++) {
            $a = $dependencies[$i][1];
            $b = $dependencies[$i][0];
            if (!array_key_exists($b, $out_count)) {
                $out_count[$b] = 0;
            }
            $out_count[$b]++;
            if (!array_key_exists($a, $in_count)) {
                $in_count[$a] = 0;
            }
            $in_count[$a]++;

            if (!array_key_exists($a, $in)) {
                $in[$a] = array();
            }
            array_push($in[$a], $b);

            if (!array_key_exists($b, $out)) {
                $out[$b] = array();
            }
            array_push($out[$b], $a);
        }
//        $base = array();
//        $ret = 0;
//        $num = 0;
//        for ($i = 1; $i <= $n; $i++) {
//            if (!array_key_exists($i, $out_count)) {
//                if (!array_key_exists($i, $in)) {
//                    $num++;
//                } else {
//                    array_push($base, $i);
//                }
//            }
//        }
//        // 拓扑排序
//        while (count($base) != 0) {
//            $temp = array();
//            for ($i = 0; $i < count($base); $i++) {
//                if (array_key_exists($base[$i], $in)) {
//                    for ($j = 0; $j < count($in[$base[$i]]); $j++) {
//                        $out_count[$in[$base[$i]][$j]]--;
//                        if ($out_count[$in[$base[$i]][$j]] == 0) {
//                            if (!in_array($in[$base[$i]][$j], $temp)) {
//                                array_push($temp, $in[$base[$i]][$j]);
//                            }
//                        }
//                    }
//                }
//            }
//            $a = (count($base)) % $k;
//            if ($a > 0) {
//                if ($num != 0) {
//                    if ($num > $k - $a) {
//                        $num -= ($k - $a);
//                    } else {
//                        $num = 0;
//                    }
//                    $ret += (int)ceil(count($base) / $k);
//                } else {
//                    $num = $a;
//                    $ret += (int)floor(count($base) / $k);
//                }
//            } else {
//                $ret += count($base) / $k;
//            }
//            $base = $temp;
//        }
////        return $ret;
//        $ret1 = $ret;
        $base = array();
        $ret = 0;
        $num = 0;
        for ($i = 1; $i <= $n; $i++) {
            if (!array_key_exists($i, $in_count)) {
                if (!array_key_exists($i, $out)) {
                    $num++;
                } else {
                    array_push($base, $i);
                }
            }
        }
        while (count($base) != 0) {
            $temp = array();
            for ($i = 0; $i < count($base); $i++) {
                if (array_key_exists($base[$i], $out)) {
                    for ($j = 0; $j < count($out[$base[$i]]); $j++) {
                        $in_count[$out[$base[$i]][$j]]--;
                        if ($in_count[$out[$base[$i]][$j]] == 0) {
                            if (!in_array($out[$base[$i]][$j], $temp)) {
                                array_push($temp, $out[$base[$i]][$j]);
                            }
                        }
                    }
                }
            }
            $a = (count($base)) % $k;
            if ($a > 0) {
                if ($num != 0) {
                    if ($num > $k - $a) {
                        $num -= ($k - $a);
                    } else {
                        $num = 0;
                    }
                    $ret += (int)ceil(count($base) / $k);
                } else {
                    $num = $a;
                    $ret += (int)floor(count($base) / $k);
                }
            } else {
                $ret += count($base) / $k;
            }
            $base = $temp;
        }
        if ($num > 0) {
            $ret += (int)ceil($num / $k);
        }
        return $ret;
//        return max($ret, $ret1);
    }
}

$solution = new Solution();
$arr = [[1,5],[1,3],[1,2],[4,2],[4,5],[2,5],[1,4],[4,3],[3,5],[3,2]];
$solution->minNumberOfSemesters(5, $arr, 3);