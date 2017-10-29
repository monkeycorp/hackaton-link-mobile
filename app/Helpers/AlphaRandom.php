<?php
namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 10/28/17
 * Time: 22:44
 */
class AlphaRandom
{
    public static function generate($length){
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }
}