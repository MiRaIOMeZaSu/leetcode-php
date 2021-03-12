<?php

/*
 class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}
*/

class DuNode
{
    public $val = null;
    public $front = null;
    public $back = null;

    function __construct($val = 0, $front = null, $back = null)
    {
        $this->val = $val;
        $this->$front = $front;
        $this->$back = $back;
    }
}

class Queue
{
    var $head;
    var $tail;

    function __construct()
    {
        $this->head = new DuNode(-INF);
        $this->tail = new DuNode(-INF);
        $this->head->back = $this->tail;
        $this->tail->front = $this->head;
    }

    function push($val)
    {
        $e = new DuNode($val);
        $front = $this->tail->front;
        $this->tail->front = $e;
        $front->back = $e;
        $e->front = $front;
        $e->back = $this->tail;
    }

    function max()
    {
        return $this->head->back->val;
    }

    function pop()
    {
        $newMax = $this->head->back->back;
        $this->head->back = $newMax;
        $newMax->front = $this->head;
    }

    function isEmpty()
    {
        return $this->head->back == $this->tail;
    }

    function end()
    {
        return $this->tail->front->val;
    }

    function removEnd()
    {
        $newEnd = $this->tail->front->front;
        $this->tail->front = $newEnd;
        $newEnd->back = $this->tail;
    }

    function remove($val)
    {
        if ($this->max() == $val) {
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
            while (!$window->isEmpty() && $window->end() < $nums[$i]) {
                $window->removEnd();
            }
            $window->push($nums[$i]);
        }
        $result[] = $window->max();
        for ($i = $k; $i < count($nums); $i++) {
            while (!$window->isEmpty() && $window->end() < $nums[$i]) {
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
$result = $solution->maxSlidingWindow([1, -1], 1);
echo $result[0];