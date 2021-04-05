<?php

class Solution
{

    /**
     * @param Integer[][] $isConnected
     * @return Integer
     */
    function findRoot($arr, $index)
    {
        while ($arr[$index] != $index) {
            $arr[$index] = $arr[$arr[$index]];
            $index = $arr[$index];
        }
        return $index;
    }

    function findCircleNum($isConnected)
    {
        // 使用数组存储连接
        // 虽然实际上没有方向,根据数组前后索引确定方向
        $ret = 0;
        $length = count($isConnected);
        $table = array();
        for ($i = 0; $i < $length; $i++) {
            array_push($table, $i);
        }
        for ($i = 0; $i < $length; $i++) {
            for ($j = $i + 1; $j < $length; $j++) {
                if ($isConnected[$i][$j] == 1) {
                    // 应该连接根
                    $table[$this->findRoot($table, $i)] = $table[$this->findRoot($table, $j)];
                }
            }
        }
        for ($i = 0; $i < $length; $i++) {
            if ($i == $table[$i]) {
                $ret++;
            }
        }
        return $ret;
    }
}

$solution = new Solution();
$arr = [[1, 0, 0, 1], [0, 1, 1, 0], [0, 1, 1, 1], [1, 0, 1, 1]];
$solution->findCircleNum($arr);