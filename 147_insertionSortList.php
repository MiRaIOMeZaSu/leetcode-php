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
     * @return ListNode
     */

    function insertionSortList($head)
    {
        $sorted = $head;
        $notSorted = $head->next;
        $sorted->next = null;
        while ($notSorted != null) {
            $node = $notSorted;
            $notSorted = $notSorted->next;
            $node->next = null;
            $sorted = $this->addNode($sorted, $node);
        }
        return $sorted;
    }

    function addNode($link, $node)
    {
        // 此函数返回的是链表的头
        if ($node->val <= $link->val) {
            $node->next = $link;
            return $node;
        }
        $head = $link;
        $last = $link;
        $link = $link->next;
        while ($link != null) {
            if ($node->val <= $link->val) {
                // 插入$link节点之前
                $last->next = $node;
                $node->next = $link;
                return $head;
            }
            $last = $link;
            $link = $link->next;
        }
        $last->next = $node;
        return $head;
    }
}