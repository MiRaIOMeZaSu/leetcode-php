<?php

class Solution
{

    /**
     * @param Integer[][] $dominoes
     * @return Integer
     */
    var $table;

    function numEquivDominoPairs($dominoes)
    {
        $ret = 0;
        $map = array();
        $this->table = array();
        for ($i = 0; $i < count($dominoes); $i++) {
            $str = "";
            if ($dominoes[$i][0] > $dominoes[$i][1]) {
                $str .= (string)$dominoes[$i][1];
                $str .= ",";
                $str .= (string)$dominoes[$i][0];
            } else {
                $str .= (string)$dominoes[$i][0];
                $str .= ",";
                $str .= (string)$dominoes[$i][1];
            }
            if (!array_key_exists($str, $map)) {
                $map[$str] = 1;
            } else {
                $map[$str]++;
            }
        }
        foreach ($map as $key => $val) {
            if ($val != 1) {
                $ret += $this->compute($val);
            }
        }
        return $ret;
    }

    function compute($num)
    {
        if (array_key_exists($num, $this->table)) {
            return $this->table[$num];
        } else {
            $ret = 0;
            $temp = $num - 1;
            while ($temp > 0) {
                $ret += $temp;
                $temp--;
            }
            $this->table[$num] = $ret;
            return $ret;
        }
    }
}