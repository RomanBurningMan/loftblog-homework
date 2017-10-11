<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 10.10.2017
 * Time: 23:42
 */
define("city", "Dnipro");

if (defined("city")) {
    echo "Константа задана";
} else {
    echo "Константа не задана";
}
//city = "Kyiv";