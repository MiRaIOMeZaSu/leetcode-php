<?php

class Solution
{

    /**
     * @param String $s
     * @param String $c
     * @return Integer[]
     */
    var $ret;

    function shortestToChar($s, $c)
    {
        $indexs = array();
        $this->ret = array();
        $size = strlen($s);
        for ($i = 0; $i < $size; $i++) {
            array_push($this->ret, 0);
            if ($s[$i] == $c) {
                array_push($indexs, $i);
            }
        }
        $indexs_size = count($indexs);
        $index = 0;
        while ($index < $indexs[0]) {
            $this->ret[$index] = $indexs[0] - $index;
            $index++;
        }
        $index = $size - 1;
        while ($index > $indexs[$indexs_size - 1]) {
            $this->ret[$index] = $index - $indexs[$indexs_size - 1];
            $index--;
        }
        for ($i = 0; $i < $indexs_size - 1; $i++) {
            // $i 到 $i+1
            $max = (int)ceil(($indexs[$i + 1] - $indexs[$i] - 1) / 2);
            $start = 1;
            for ($j = $indexs[$i] + 1; $j < $indexs[$i + 1]; $j++) {
                if ($start > $max) {
                    break;
                }
                $this->ret[$j] = $start;
                $start++;
            }
            $start = 1;
            for ($j = $indexs[$i + 1] - 1; $j > $indexs[$i]; $j--) {
                if ($start > $max) {
                    break;
                }
                $this->ret[$j] = $start;
                $start++;
            }
        }
        return $this->ret;
    }
}

$solution = new Solution();
$solution->shortestToChar("ldwawaeeeeaawareaeeedasasasdawoveleetcodedahosoaubfwfodhauiwbuarofaofausauieyuaieffa", 'e');