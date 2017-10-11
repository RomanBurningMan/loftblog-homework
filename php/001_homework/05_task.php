<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 11.10.2017
 * Time: 21:35
 */

$day = rand(1, 10);
echo "День - $day<br>";
switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Это рабочий день";
        break;
    case 6:
    case 7:
        echo "Это выходной день";
        break;
    default:
        echo "Неизвестный день";
}