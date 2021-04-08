<?php

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

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution
{

    /**
     * @param TreeNode $root
     * @return Integer
     */
    public $ret;

    function sumNumbers($root)
    {
        $this->ret = 0;
        $this->solve($root, 0);
        return $this->ret;
    }

    function solve($root, $num)
    {
        $nextNum = $num * 10 + $root->val;
        if ($root->left != null) {
            $this->solve($root->left, $nextNum);
        } else if ($root->right == null) {
            $this->ret += $nextNum;
            return;
        }
        if ($root->right != null) {
            $this->solve($root->right, $nextNum);
        }
    }
}

$solution = new Solution();
$root = new TreeNode(1);
$left = new TreeNode(0);
$root->left = $left;

$solution->sumNumbers($root);