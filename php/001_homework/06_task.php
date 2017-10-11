<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 11.10.2017
 * Time: 22:02
 */
$cars = array(
    "bmw" => array("model" => "X5", "speed" => 120, "doors" => 5, "year" => "2015"),
    "toyota" => array("model" => "Corola", "speed" => 280, "doors" => 5, "year"  => "2008"),
    "opel" => array("model" => "Astra", "speed" => 260, "doors" => 3, "year"  => "2011")
);

foreach ($cars as $name => $value) {
    echo "<p>CAR $name<br>";
    foreach ($value as $prop) {
        echo $prop." ";
    }
    echo "</p>";
}
