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
$startLength = count($arr);
$i = $startLength - 1;

while ($i >= 0) {
    $arr[] = $arr[$i];
    $i--;
}

array_splice($arr, 0, $startLength);
$newStr = implode('|', $arr);

echo $newStr;