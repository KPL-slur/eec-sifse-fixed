<?php

namespace App\Services;

class Utility{

    /**
     * solution from here https://stackoverflow.com/a/4128377
     */
    public function in_array_r($needle, $haystack, $strict = false) 
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
    
        return false;
    }

    /**
     * convert from iso YYYY/MM/DD to daily usage format
     */
    public function easyToReadDate($start, $end)
    {
        if (date("F Y", strtotime($start)) == date("F Y", strtotime($end))) {
            $date = date('j', strtotime($start)) . " s.d " . date('j F Y', strtotime($end));
        } elseif (date("Y", strtotime($start)) == date("Y", strtotime($end))) {
            $date = date('j F', strtotime($start)) . " s.d " . date('j F Y', strtotime($end));
        } else {
            $date = date('j F Y', strtotime($start)) . " s.d " . date('j F Y', strtotime($end));
        }

        return $date;
    }
}