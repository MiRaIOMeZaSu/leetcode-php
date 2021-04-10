<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    var $nums;
    var $ret;
    var $size;

    function maxSumDivThree($nums)
    {
        // 回溯法
        sort($nums);
        $this->nums = &$nums;
        $this->size = count($nums);
        $sum = 0;
        for ($i = 0; $i < count($nums); $i++) {
            $sum += $nums[$i];
        }
        $this->ret = 0;
        $this->solve(0, $sum);
        return $this->ret;
    }

    function solve($index, $sum)
    {
        if ($sum % 3 == 0 && $sum != 0) {
            $this->ret = max($sum, $this->ret);
            return;
        }
        for ($i = $index; $i < $this->size; $i++) {
            $sum -= $this->nums[$i];
            if ($sum > $this->ret) {
                // 若小于则不会执行此步骤
                $this->solve($i + 1, $sum);
            } else {
                // 之后删除的只会更大,导致返回值更小
                break;
            }
            $sum += $this->nums[$i];
        }
    }
}

$solution = new Solution();
$arr = [366,809,6,792,822,181,210,588,344,618,341,410,121,864,191,749,637,169,123,472,358,908,235,914,322,946,738,754,908,272,267,326,587,267,803,281,586,707,94,627,724,469,568,57,103,984,787,552,14,545,866,494,263,157,479,823,835,100,495,773,729,921,348,871,91,386,183,979,716,806,639,290,612,322,289,910,484,300,195,546,499,213,8,623,490,473,603,721,793,418,551,331,598,670,960,483,154,317,834,352];
$solution->maxSumDivThree($arr);