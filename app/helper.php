<?php
// ------------- GLOBAL FUNCTION 

function gb_dd($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

function gb_get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function gb_require_files($dir)
{
    foreach (glob(__DIR__ . "/.." . $dir) as $filename)
    {
        require_once(realpath($filename));
    }
}