<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 10.10.2017
 * Time: 23:25
 */
echo "<p>Дана задача: На школьной выставке 80 рисунков. 23 из них выполнены фломастерами, 40 карандашами, а остальные"
    ."— красками. Сколько рисунков, выполненные красками, на школьной выставке?</p>";

function getColorDrawing() {
    $all_drawing = 80;
    $felt_pen_drawing = 23;
    $pen_drawing = 40;
    return $all_drawing - $felt_pen_drawing - $pen_drawing;
}

echo 'Красками выполнено - '.getColorDrawing().' рисунков.';