<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 21.10.2017
 * Time: 16:05
 */
function task1 ($url)
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
