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


    function findMin($root, $parent = null)
    {
        return $root->left == null ? [$root, $parent] : $this->findMin($root->left, $root);
    }

    function findNode($root, $target, $parent = null)
    {
        if ($root == null) {
            return [null, null];
        }
        // 返回新的结点
        if ($root->val == $target) {
            return [$root, $parent];
        } elseif ($root->val > $target) {
            return $this->findNode($root->left, $target, $root);
        }
        return $this->findNode($root->right, $target, $root);
    }
    /*
    function sink($root, $parent)
    {
        // 实际情况下不应该直接替换val,因为这样变更占用空间大的数据时反而不如直接变化指针
        // 下沉

        if ($root->left == null) {
            if ($root->right == null) {
                // 两边都为空
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
    */
    /**
     * @param TreeNode $root
     * @param Integer $key
     * @return TreeNode
     */
    function deleteNode($root, $key)
    {
        // 首先找到需要删除的节点；
        // 如果找到了，删除它。
        $arr = $this->findNode($root, $key);
        $target = $arr[0];
        if (!$target) {
            return $root;
        }
        $parent = $arr[1];
        if ($parent == null && $target->left == null && $target->right == null) {
            return null;
        }
        $new = null;
        $newRoot = $root;
        if($root==$target){
            if($target->left == null || $target->right == null){
                $flag= true;
            }
        }
        while ($target->left != null || $target->right != null) {
            if ($target->right == null) {
                // 只有右子树为空
                $new = $target->left;
                $target->left = null;
                if ($parent) {
                    // 如果存在父节点
                    if ($parent->left == $target) {
                        $parent->left = $new;
                    } elseif ($parent->right == $target) {
                        $parent->right = $new;
                    }
                }
                break;
            } elseif ($target->left == null) {
                // 只有左子树为空
                $new = $target->right;
                $target->right = null;
                if ($parent) {
                    // 如果存在父节点
                    if ($parent->left == $target) {
                        $parent->left = $new;
                    } elseif ($parent->right == $target) {
                        $parent->right = $new;
                    }
                }
                break;
            }
            // 任一子树均不为空,此时寻找右子树最小节点或左子树最大结点
            $arr2 = $this->findMin($target->right, $target);
            // min与target交换位置
            $new = $arr2[0];
            if ($target == $root) {
                $newRoot = $new;
            }
            $left = $new->left;
            $right = $new->right;
            $minParent = $arr2[1];
            if ($minParent != $target) {
                // 最小结点就是target右子树
                // $new = $target->right;
                $new->left = $target->left;
                $new->right = $target->right;
                // 原来的parents:
                if ($minParent) {
                    // 如果存在父节点
                    if ($minParent->left == $new) {
                        $minParent->left = null;
                    } else {
                        $minParent->right = null;
                    }
                }
            } else {
                // $new = $target->right;

                $new->left = $target->left;
                $new->right = $target;
                if (!$parent) {
                    $parent = $new;
                }else{
                    // 如果存在父节点
                    if ($parent->left == $target) {
                        $parent->left = $new;
                    } elseif ($parent->right == $target) {
                        $parent->right = $new;
                    }
                }
                if($right != null || $right != null){
                    $parent = $new;
                }
            }
            $target->right = $right;
            $target->left = $left;
        }

        // 如果存在父节点
        if ($new->left == $target) {
            $new->left = null;
        } elseif ($new->right == $target) {
            $new->right = null;
        }
        if ($parent) {
            // 如果存在父节点
            if ($parent->left == $target) {
                $parent->left = $new;
            } elseif ($parent->right == $target) {
                $parent->right = $new;
            }
        }

        if ($root == $target) {
            if($flag){
                return $new;
            }
            return $newRoot;
        } else {
            return $root;
        }
    }
}

$root = new TreeNode();
$root->val = 1;
$root->right = new TreeNode(2);
//$root->right->left = new TreeNode(6);
//$root->right->left->left = new TreeNode(5);
//$root->right->right = new TreeNode(8);
//$root->right->right->right = new TreeNode(9);


//$root = new TreeNode();
//$root->val = 0;
//$root->left = new TreeNode(3);
//$root->left->left = new TreeNode(2);
//$root->left->right = new TreeNode(4);
//$root->right = new TreeNode(6);
//$root->right->right = new TreeNode(7);
/*
$root = new TreeNode();
$root->val = 5;
$root->left = new TreeNode(3);
$root->left->left = new TreeNode(2);
$root->left->right = new TreeNode(4);
$root->right = new TreeNode(6);
$root->right->right = new TreeNode(7);
*/
/*
$root->val = 50;
$root->left = new TreeNode(30);
//$root->left->left = new TreeNode(2);
$root->left->right = new TreeNode(40);
$root->right = new TreeNode(70);
$root->right->left = new TreeNode(60);
$root->right->right = new TreeNode(80);
*/
$solution = new Solution();
$result = $solution->deleteNode($root, 1);
echo $result->val;