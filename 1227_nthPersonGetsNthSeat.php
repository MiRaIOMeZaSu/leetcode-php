<?php
class Solution {

    /**
     * @param Integer $n
     * @return Float
     */
    function nthPersonGetsNthSeat($n) {
        if($n == 1){
            return (float)1;
        }else{
            return 1/2;
        }
    }
}