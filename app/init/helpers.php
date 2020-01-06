<?php

if (!function_exists('dd'))
{
    function dd($var, ...$moreVars)
    {
        echo '<pre>';
        var_dump($var);

        foreach ($moreVars as $v) {
            var_dump($v);
        }
        echo '</pre>';

        exit(1);
    }
}