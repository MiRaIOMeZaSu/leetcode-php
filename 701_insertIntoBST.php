<?php

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
     * @param Integer $val
     * @return TreeNode
     */
    function insertIntoBST($root, $val)
    {
        if(!$root){
            return new TreeNode($val);
        }
        $this->insert($root,$val,$root);
        return $root;
    }

    function insert($root, $val, $top)
    {
        // 已知传入的值不在BST内
        if ($root->val > $val) {
            // val小于root的值
            if (!$root->left) {
                // 不存在left
                $root->left = new TreeNode($val);
            } else {
                // 存在left
                $this->insert($root->left, $val, $top);
            }
        } else {
            // val大于root的值
            if (!$root->right) {
                $root->right = new TreeNode($val);
            } else {
                $this->insert($root->right, $val, $top);
            }
        }
    }
}