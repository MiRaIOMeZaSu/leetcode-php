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

    function exchPos($target, $repl, $targetParen = null, $replParen = null)
    {
        // target必须在repl上面
        $targetL = $target->left;
        $targetR = $target->right;
        $replL = $repl->left;
        $replR = $repl->right;
        if ($targetL == $repl) {
            // 更改parent的一个指针
            if ($targetParen) {
                if ($targetParen->left == $target) {
                    $targetParen->left = $repl;
                } elseif ($targetParen->right == $target) {
                    $targetParen->right = $repl;
                }
            }
            // 更改repl的两个指针
            $repl->left = $target;
            $repl->right = $targetR;
            // 更改target的两个指针
            $target->left = $replL;
            $target->right = $replR;
            return [$repl, $targetParen];
        } elseif ($targetR == $repl) {
            // 更改parent的一个指针
            if ($targetParen) {
                if ($targetParen->left == $target) {
                    $targetParen->left = $repl;
                } elseif ($targetParen->right == $target) {
                    $targetParen->right = $repl;
                }
            }
            // 更改repl的两个指针
            $repl->left = $targetL;
            $repl->right = $target;
            // 更改target的两个指针
            $target->left = $replL;
            $target->right = $replR;
            return [$repl, $targetParen];
        } else {
            // 此时替换与被替换不相连
            if ($targetParen) {
                if ($targetParen->left == $target) {
                    $targetParen->left = $repl;
                } elseif ($targetParen->right == $target) {
                    $targetParen->right = $repl;
                }
            }
            if ($replParen->left == $repl) {
                $replParen->left = $target;
            } elseif ($replParen->right == $repl) {
                $replParen->right = $target;
            }
            // 更改repl的两个指针
            $repl->left = $targetL;
            $repl->right = $targetR;
            // 更改target的两个指针
            $target->left = $replL;
            $target->right = $replR;
            return [$replParen, $targetParen];
        }
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
            // 如果没找到,原样返回
            return $root;
        }
        $targetParen = $arr[1];
        if ($targetParen == null && $target->left == null && $target->right == null) {
            // 删除唯一的元素
            return null;
        }
        // fixme
        $parenArr = null;
        while ($target->left != null || $target->right != null) {
            if ($target->right == null) {
                // 只有右子树为空
                if ($root == $target) {
                    return $target->left;
                }else{
                    $repl = $target->left;
                    if ($targetParen->left == $target) {
                        $targetParen->left = $repl;
                    } elseif ($targetParen->right == $target) {
                        $targetParen->right = $repl;
                    }
                    return $root;
                }
//                $repl = $target->left;
//                $parenArr = $this->exchPos($target, $target->left, $targetParen, $target);
//                $targetParen = $parenArr[0];


                // 此处的做法是正确的
            } else {
                // 右子树不为空
                // 当右子树的左子树不为空,寻找右子树最小
                $arr2 = $this->findMin($target->right, $target);
                // min与target交换位置
                $repl = $arr2[0];
                $replParent = $arr2[1];
                $parenArr = $this->exchPos($target, $repl, $targetParen, $replParent);
                $targetParen = $parenArr[0];
//                  $replParent = $parenArr[1];
                if ($root == $target) {
                    $root = $repl;
                }
            }
        }
        if ($targetParen) {
            if ($targetParen->left == $target) {
                $targetParen->left = null;
            } elseif ($targetParen->right == $target) {
                $targetParen->right = null;
            }
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
$result = $solution->deleteNode($root, 5);
echo $result->val;