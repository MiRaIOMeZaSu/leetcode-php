<?php

class Solution
{

    /**
     * @param String $astr
     * @return Boolean
     */
    function isUnique($astr)
    {
        $bit = 0;
        for ($i = 0; $i < strlen($astr); $i++) {
            $num = ord($astr[$i]) - ord('a');
            $temp = $bit | 1 << $num;
            if ($temp==$bit){
                return false;
            }
            $bit = $temp;
        }
        return true;
    }
}

$solution = new Solution();
$solution->isUnique("leetcode");