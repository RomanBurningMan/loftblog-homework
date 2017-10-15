<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 11.10.2017
 * Time: 23:21
 */
$str = "str int bool null0";
echo "$str<br>";

$arr = explode(" ", $str);
$length = count($arr);
$additionalVar = null;
$i = 0;

while ($i <= $length/2 - 1) {
    $additionalVar = $arr[$i];
    $arr[$i] = $arr[$length - 1 - $i];
    $arr[$length - 1 - $i] = $additionalVar;
    $i++;
}

$newStr = implode('|', $arr);

echo $newStr;