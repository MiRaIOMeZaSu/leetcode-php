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
     * @param Integer $targetSum
     * @return Integer[][]
     */
    var $ret;
    var $set;

    function pathSum($root, $targetSum)
    {
        // 简单的回溯法(深度优先
        $this->ret = array();
        $this->set = array();
        if ($root == null) {
            return $this->ret;
        }
        $this->solve($root, $targetSum);
        return $this->ret;
    }

    function solve($root, $sum)
    {
        $val = $sum - $root->val;
        array_push($this->set, $root->val);
        if ($root->left == null && $root->right == null) {
            if ($val == 0) {
                $this->put();
//                array_pop($this->set);
            }
            return;
        } else {
            if ($root->left != null) {
                $this->solve($root->left, $val);
                array_pop($this->set);
            }
            if ($root->right != null) {
                $this->solve($root->right, $val);
                array_pop($this->set);
            }
        }
    }

    function put()
    {
        $temp = array();
        for ($i = 0; $i < count($this->set); $i++) {
            array_push($temp, $this->set[$i]);
        }
        array_push($this->ret, $temp);
    }
}

