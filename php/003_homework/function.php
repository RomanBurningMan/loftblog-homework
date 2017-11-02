<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 21.10.2017
 * Time: 16:05
 */
function task1($url)
{
    $xml = simplexml_load_file($url);
    $items = $xml->Items->children();
    $countGoods = $items->count();

    echo "<style>
        table {
            border-collapse: collapse;
        }
        table td {
            vertical-align: top;
            padding: 10px;
            border: 1px solid #000;
        }
    </style>";
    echo "Order number: " . $xml['PurchaseOrderNumber'] . "<br>";
    echo "Date: " . $xml['OrderDate'] . "<br>";
    echo "<table>
        <tr>
            <td>№</td>
            <td>Part Number</td>
            <td>Product</td>
            <td>Quantity</td>
            <td>Price, USD</td>
            <td>Ship date</td>
            <td>Comment</td>
            <td>Type</td>
            <td>Address</td>
        </tr>";
    for ($i = 0; $i < $countGoods; $i++) {
        $currentItem = $items[$i];
        $itemNum = $i + 1;
        $address = $xml->Address[$i];
        echo "<tr>
        <td>" . $itemNum . "</td>
        <td>" . $currentItem['PartNumber'] . "</td>
        <td>" . $currentItem->ProductName . "</td>
        <td>" . $currentItem->Quantity . "</td>
        <td>" . $currentItem->USPrice . "\$</td>
        <td>" . $currentItem->ShipDate . "</td>
        <td>" . $currentItem->Comment . "</td>
        <td>" . $address['Type'] . "</td>
        <td>";
        foreach ($address as $value) {
            echo $value . "<br>";
        }
        echo "</td>
        <tr>";
    }
    echo "</table>";
    return $xml;
}

function task2($arr) {
    function makeJson($arr, $secondFile='') {
        $json = json_encode($arr);
        $open = fopen('./output'.$secondFile.'.json','w');
        fwrite($open, $json);
        fclose($open);
        return $arr;
    }

    function compareJson($arr1, $arr2) {
        foreach ($arr1 as $key => $value) {
            $result = array_key_exists($key, $arr2);
            if (!$result) {
                throw new Exception("Second file don't exist value: '$key'.");
            } elseif (is_array($value)) {
                if (is_array($arr2[$key])) {
                    compareJson($arr1[$key], $arr2[$key]);
                } else {
                    throw new Exception("Second file don't exist array in key: '$key'");
                }
            } elseif ($arr2[$key] != $value) {
                throw new Exception("Second file has different value - '$arr2[$key]' for key '$key'.");
            }
        }
        return true;
    }

    if (rand(0,1)) {
//        $arr["country for import"][4] = "Romania";
        makeJson($arr, '2');
        $decodeFile1 = json_decode(file('./output.json')[0], true);
        $decodeFile2 = json_decode(file('./output2.json')[0], true);
        try {
            compareJson($decodeFile1, $decodeFile2);
            echo "<p>Files are the same!</p>";
        } catch (Exception $e) {
            echo $e->getMessage()."<br>";
        }
    } else {
        makeJson($arr);
        echo "<p>Create one json file!</p>";
    }
}

function task3() {
    $numArr = array();
    $i=0;
    while ($i < 50) {
        $numArr[] = rand(1, 100);
        $i++;
    }

    $openFile = fopen('nums.csv','w');
    fputcsv($openFile, $numArr);
    fclose($openFile);

    $readFile = fopen('nums.csv','r');
    $data = fgetcsv($readFile);
    $summ = 0;
    foreach ($data as $num) {
        $summ += $num;
    }
    fclose($readFile);

    echo "<p>$summ</p>";

    return $summ;
}

function task4() {
    $url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($curl),1);
    curl_close($curl);

    function findValue($arr, $keyName) {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                findValue($value, $keyName);
            } elseif ($key == $keyName) {
                echo $arr[$key]."<br>";
                break;
            }
        }
    }

    findValue($result,'pageid');
    findValue($result,'title');

    return true;
}