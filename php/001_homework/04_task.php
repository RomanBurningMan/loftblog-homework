<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 11.10.2017
 * Time: 21:24
 */
$age = rand(-10, 100);
echo "Ваш возраст - $age<br>";
if ($age >= 18 && $age <=65) {
    echo "Вам еще работать и работать!";
} elseif ($age > 65) {
    echo "Вам пора на пенсию!";
} elseif ($age > 0 && $age < 18) {
    echo "Вам еще рано работать!";
} else {
    echo "Неизвестный возраст.";
}