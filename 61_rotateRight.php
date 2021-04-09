<?php

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution
{

    /**
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    var $tail;
    var $head;

    function rotateRight($head, $k)
    {
        if ($head == null || $head->next == null || $k == 0) {
            return $head;
        }
        $len = $this->getlen($head, $k);
        $temp = $k % $len;
        if ($temp != 0) {
            $distance = $len - $temp;
        } else {
            return $head;
        }
        $index = 0;
        $curr = $head;
        while ($index < $distance - 1) {
            $curr = $curr->next;
            $index++;
        }
        $this->head = $curr->next;
        $curr->next = null;
        $this->tail->next = $head;
        return $this->head;
    }

    function getlen($line)
    {
        $ret = 0;
        $slow = $line;
        $fast = $line;
        $end = $line;
        while ($fast != null) {
            $end = $fast;
            $slow = $slow->next;
            $fast = $fast->next;
            if ($fast != null) {
                $end = $fast;
                $fast = $fast->next;
            } else {
                $ret++;
                break;
            }
            $ret += 2;
        }
        $this->tail = $end;
        return $ret;
    }
}

$_1 = new ListNode(1);
$_1_2 = new ListNode(2);
$_1_3 = new ListNode(3);
$_1_4 = new ListNode(4);
$_1_5 = new ListNode(5);
$_1_6 = new ListNode(6);
$_1_7 = new ListNode(7);
$_1_8 = new ListNode(8);
$_1_9 = new ListNode(9);
$_1->next = $_1_2;
$_1_2->next = $_1_3;
$_1_3->next = $_1_4;
$_1_4->next = $_1_5;
//$_1_5->next = $_1_6;
//$_1_6->next = $_1_7;
//$_1_7->next = $_1_8;
//$_1_8->next = $_1_9;
$solution = new Solution();
$solution->rotateRight($_1, 2);