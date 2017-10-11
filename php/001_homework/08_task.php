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
$newArr = array();
$i = count($arr) - 1;
while ($i >= 0) {
    $newArr[] = $arr[$i];
    $i--;
}
$newStr = implode('|', $newArr);
echo $newStr;