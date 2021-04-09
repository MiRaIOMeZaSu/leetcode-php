<?php

class Solution
{

    /**
     * @param Integer[] $coins
     * @param Integer $amount
     * @return Integer
     */
    var $nums;
    var $size;
    var $ret;

    function coinChange($coins, $amount)
    {
        // 使用回溯法,匹配成功时即返回,若到最后还没成功则说明失败
        rsort($coins);
        $this->nums = &$coins;
        $this->size = count($coins);
        $this->ret = PHP_INT_MAX;
        $this->solve($amount, 0, 0);
        return $this->ret != PHP_INT_MAX ? $this->ret : -1;
    }

    function solve($amount, $index, $count)
    {
        if ($amount < 0) {
            return;
        } else if ($amount == 0) {
            $this->ret = min($count, $this->ret);
            return;
        }
        if ($index == $this->size - 1) {
            if ($amount % $this->nums[$index] == 0) {
                $this->ret = min($count + $amount / $this->nums[$index], $this->ret);
            }
            return;
        }
        for ($i = $index; $i < $this->size; $i++) {
            $this->solve($amount - $this->nums[$i], $i, $count + 1);
        }
    }
}


$solution = new Solution();
$arr = [1, 2, 5];
$solution->coinChange($arr, 11);