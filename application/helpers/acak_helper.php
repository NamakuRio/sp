<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('acak_helper'))
{
    function acak($panjang)
    {
        $karakter = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $string = "";

        for($i = 0;$i < $panjang;$i++){
            $pos = rand(0, strlen($karakter)-1);
            $string .= $karakter{$pos};
        }

        return $string;
    }
}