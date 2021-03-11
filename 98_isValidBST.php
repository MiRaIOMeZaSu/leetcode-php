<?php

/**
 * Definition for a binary tree node.
 * class TreeNode {
 * public $val = null;
 * public $left = null;
 * public $right = null;
 * function __construct($val = 0, $left = null, $right = null) {
 * $this->val = $val;
 * $this->left = $left;
 * $this->right = $right;
 * }
 * }
 */
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

class Solution
{
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST($root)
    {
        $max = INF;
        $min = -INF;
        return $this->valid($root, $min, $max);
    }

    function valid($root, $min, $max)
    {
        if ($root->val <= $min || $root->val >= $max) {
            return false;
        }
        if ($root->left == null) {
            if ($root->right == null) {
                // 左右都为空
                return true;
            } else {
                // 只有左边为空,右边不为空
                return $root->val < $root->right->val
                    && $this->valid($root->right, $root->val, $max);
            }
        } elseif ($root->right == null) {
            // 只有右边为空,左边不为空
            return $root->val > $root->left->val
                && $this->valid($root->left, $min, $root->val);
        }
        // 都不为空
        return ($root->val > $root->left->val && $this->valid($root->left, $min, $root->val)) &&
            ($root->val < $root->right->val && $this->valid($root->right, $root->val, $max));
    }
}


$root = new TreeNode();
$root->val = 3;
$root->right = new TreeNode(5);
$root->right->left = new TreeNode(4);
$root->right->right = new TreeNode(6);
$root->left = new TreeNode(1);
$root->left->left = new TreeNode(0);
$root->left->right = new TreeNode(2);
$root->left->right->right = new TreeNode(3);


$solution = new Solution();
$result = $solution->isValidBST($root);
echo $result;