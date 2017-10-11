<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 11.10.2017
 * Time: 22:48
 */
echo "<table>";
for ($i = 0; $i < 10; $i++) {
    echo "<tr>";
    for ($i2 = 0; $i2 < 10; $i2++) {
        $multiply = ($i+1)*($i2+1);
        $checkData = $i%2 + $i2%2;
        if ($checkData == 0) {
            echo "<td>($multiply)</td>";
        } elseif ($checkData == 2) {
            echo "<td>[$multiply]</td>";
        } else {
            echo "<td>$multiply</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";