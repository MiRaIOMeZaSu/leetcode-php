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
    function addTwoNumbers($l1, $l2)
    {
        $_1 = 0;
        $_2 = 0;
        while ($l1 != null) {
            $_1 = $_1 * 10 + $l1->val;
            $l1 = $l1->next;
        }
        while ($l2 != null) {
            $_2 = $_2 * 10 + $l2->val;
            $l2 = $l2->next;
        }
        $num = $_1 + $_2;
        $str = (string)$num;
        $head = new ListNode(-1);
        $curr = $head;
        for ($i = 0; $i < strlen($str); $i++) {
            $temp = new ListNode((int)$str[$i]);
            $curr->next = $temp;
            $curr = $curr->next;
        }
        return $head->next;
    }
}