<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 21.10.2017
 * Time: 16:04
 */
require_once 'function.php';

//task1('data.xml');

$goodsItem = array(
    "item-name" => "soap",
    "costs" => "180$",
    "country" => "Bangladesh",
    "constraints" => "16+",
    "country for import" => array("Argentina","Peru","Mexico","Brazil","France")
);

//task2($goodsItem);

//task3();
echo "<pre>";
$url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
$result = curl_exec($curl);
curl_close($curl);
