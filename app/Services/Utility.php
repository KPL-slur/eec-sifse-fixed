<?php

namespace App\Services;

class Utility{
    // solution from here https://stackoverflow.com/a/4128377
    // need to move to somewhere else
    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
    
        return false;
    }
}