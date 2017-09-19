<?php

if (! function_exists('random_array')) {
    function random_array($min, $max, $length)
    {
        $count = 0;
        $dices = [];

        foreach (range(1, $length) as $item) {
            array_push($dices, random_int($min, $max));
        }

        return $dices;
    }
}
