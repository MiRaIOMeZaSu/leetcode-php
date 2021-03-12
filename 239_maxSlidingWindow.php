<?php

class Queue
{
    var $arr;

    function __construct()
    {
        $this->arr = array();
    }

    function push($e)
    {
        $this->arr[] = $e;
    }

    function max()
    {
        return $this->arr[0];
    }

    function pop()
    {
        $this->arr = array_slice($this->arr, 1);
    }

    function size()
    {
        return count($this->arr);
    }

    function end()
    {
        return $this->arr[count($this->arr) - 1];
    }

    function removEnd()
    {
        $this->arr = array_slice($this->arr, 0, count($this->arr) - 1);
    }
    function remove($e){
        if($this->max()==$e){
            $this->pop();
        }
    }
}

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function maxSlidingWindow($nums, $k)
    {
        // k为窗口的大小
        // 窗口从开始到结尾
        $result = array();
        $window = new Queue();
        for ($i = 0; $i < $k; $i++) {
            while ($window->size() > 0 && $window->end() < $nums[$i]) {
                $window->removEnd();
            }
            $window->push($nums[$i]);
        }
        $result[] = $window->max();
        for ($i = $k; $i < count($nums); $i++) {
            while ($window->size() > 0 && $window->end() < $nums[$i]) {
                $window->removEnd();
            }
            $window->remove($nums[$i - $k]);
            $window->push($nums[$i]);
            $result[] = $window->max();
        }
        return $result;
    }
}

// 执行
$solution = new Solution();
$result = $solution->maxSlidingWindow([1,-1], 1);
echo $result[0];