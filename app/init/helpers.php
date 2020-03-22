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

if (!function_exists('formatFileName'))
{
    function formatFileName($file_name)
    {
        if (stristr(PHP_OS, 'WIN')) {
            $file_name = iconv('UTF-8', 'GBK', $file_name);
        }
        return $file_name;
    }
}

