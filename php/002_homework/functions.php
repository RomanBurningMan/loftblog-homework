<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 12.10.2017
 * Time: 23:11
 */
function createParagraphs($arr, $bool = false) {
    foreach ($arr as $val) {
        echo "<p>$val</p>";
    }
    if ($bool == true) {
        return implode(" ", $arr);
    }
}