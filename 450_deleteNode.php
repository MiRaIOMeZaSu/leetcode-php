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
     * @param Integer $key
     * @return TreeNode
     */
    function findNode($root, $target, $parent = null)
    {
        if ($root == null) {
            return null;
        }
        // 返回新的结点
        if ($root->val == $target) {
            return [$root, $parent];
        } elseif ($root->val > $target) {
            return $this->findNode($root->left, $target, $root);
        }
        return $this->findNode($root->right, $target, $root);
    }
    function sink($root, $parent)
    {
        // 实际情况下不应该直接替换val,因为这样变更占用空间大的数据时反而不如直接变化指针
        // 下沉

        if ($root->left == null) {
            if ($root->right == null) {
                // 两边都为空
//                if ($parent != null) {
//                    if ($parent->left == $root) {
//                        $parent->left = null;
//                    } else {
//                        $parent->right = null;
//                    }
//                }
                return $root;
            }
        } elseif ($root->right == null) {
            // 只有右边为空
            if ($parent != null) {
                if ($parent->left == $root) {
                    $parent->left = $root->left;
                } else {
                    $parent->right = $root->left;
                }
            }
            $left = $root->left->left;
            $right = $root->left->right;
            $repla = $root->left;
//            if($root->$right != null){
//                $repla->left = $root->left;
//            }
            $repla->right = null;
            $repla->left = $root;

            $root->left = $left;
            $root->right = $right;

            return $root->left;
        }
        // 两边都不为空
        // 只有左边为空
        if ($parent != null) {
            if ($parent->left == $root) {
                $parent->left = null;
                $parent->left = $root->right;
            } else {
                $parent->right = null;
                $parent->right = $root->right;
            }
        }
        $left = $root->right->left;
        $right = $root->right->right;
        $repla = $root->right;
        if($root->left != null){
            $repla->left = $root->left;
        }
        $repla->right = $root;

        $root->left = $left;
        $root->right = $right;
        return  $repla;
    }
    function deleteNode($root, $key)
    {
        // 首先找到需要删除的节点；
        // 如果找到了，删除它。
        $arr = $this->findNode($root, $key);
        $target = $arr[0];
        if(!$target){
            return $root;
        }
        $parent = $arr[1];
        $todel = $this->sink($target, $parent);

        if($root->val==$key){
            $root = $todel;
        }
        while ($target != $todel) {
            $parent = $todel;
            $todel = $this->sink($target, $todel);
        }
        // 此时$root == $todel
        if ($parent != null) {
            if ($parent->left == $target) {
                $parent->left = null;
            } else {
                $parent->right = null;
            }
        }else{
            return null;
        }
        return $root;
    }
}
$root = new TreeNode();
$root->val = 5;
$root->left = new TreeNode(3);
$root->left->left = new TreeNode(2);
$root->left->right = new TreeNode(4);
$root->right = new TreeNode(6);
$root->right->right = new TreeNode(7);
$solution = new Solution();
$solution->deleteNode($root, 7);
