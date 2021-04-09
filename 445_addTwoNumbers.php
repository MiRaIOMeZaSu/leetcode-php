<?php

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution
{

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    var $long;
    var $short;
    var $len_long;
    var $len_short;
    var $head;

    function addTwoNumbers($l1, $l2)
    {
        // 使用后序遍历
        // 统计长度
        $len1 = $this->getlen($l1);
        $len2 = $this->getlen($l2);
        $this->long = $len1 > $len2 ? $l1 : $l2;
        $this->len_long = $len1 > $len2 ? $len1 : $len2;
        $this->len_short = $len1 > $len2 ? $len2 : $len1;
        $this->short = $len1 > $len2 ? $l2 : $l1;
        $this->head = new ListNode(-1);
        $temp = $this->plus($this->head, 0);
        if ($temp != 0) {
            $this->head->val = $temp;
            return $this->head;
        }
        return $this->head->next;
    }

    function plus($head, $index)
    {
        if ($index >= $this->len_long) {
            return 0;
        }
        $curr = new ListNode(-1);
        $head->next = $curr;
        if ($index < $this->len_long - $this->len_short) {
            $curr->val = $this->long->val;
            $this->long = $this->long->next;
        } else {
            $curr->val = $this->long->val + $this->short->val;
            $this->long = $this->long->next;
            $this->short = $this->short->next;
        }
        $curr->val += $this->plus($curr, $index + 1);
        $temp = (int)floor($curr->val / 10);
        $curr->val = $curr->val % 10;
        return $temp;
    }

    function getlen($line)
    {
        $ret = 0;
        $slow = $line;
        $fast = $line;
        while ($fast != null) {
            $slow = $slow->next;
            $fast = $fast->next;
            if ($fast != null) {
                $fast = $fast->next;
            } else {
                $ret++;
                break;
            }
            $ret += 2;
        }
        return $ret;
    }
}

$solution = new Solution();
// (7 -> 2 -> 4 -> 3) + (5 -> 6 -> 4)
$_1 = new ListNode(7);
$_1_2 = new ListNode(2);
$_1_3 = new ListNode(4);
$_1_4 = new ListNode(3);
$_1->next = $_1_2;
$_1_2->next = $_1_3;
$_1_3->next = $_1_4;
$_2 = new ListNode(5);
$_2_2 = new ListNode(6);
$_2_3 = new ListNode(4);
$_2->next = $_2_2;
$_2_2->next = $_2_3;
$solution->addTwoNumbers($_1, $_2);