<?php
/**
 * Created by PhpStorm.
 * User: Roman Kushnir
 * Date: 12.10.2017
 * Time: 23:11
 */
function task1($arr, $bool = false) {
    foreach ($arr as $val) {
        echo "<p>$val</p>";
    }
    if ($bool == true) {
        return implode(" ", $arr);
    }
    return true;
}
function task2($arr, $operator) {
    if (gettype($arr) != "array") {
        echo "<p>Первым аргументом введен не массив.</p>";
        return true;
    } else {
        foreach ($arr as $value) {
            if (gettype($value) != "integer") {
                echo "<p>Массив должен состоять только из чисел</p>";
                return true;
            }
        }
    }
    $totalNum = 0;
    switch($operator){
        case '+':
            foreach ($arr as $value) {
                if ($totalNum == 0) {
                    $totalNum = $value;
                } else {
                    $totalNum += $value;
                }
            }
            break;
        case '-':
            foreach ($arr as $value) {
                if ($totalNum == 0) {
                    $totalNum = $value;
                } else {
                    $totalNum -= $value;
                }
            }
            break;
        case '*':
            if ($totalNum == 0) $totalNum = 1;
            foreach ($arr as $value) {
                $totalNum *= $value;
            }
            break;
        case '/':
            if ($totalNum == 0) $totalNum = 1;
            foreach ($arr as $value) {
                $totalNum /= $value;
            }
            break;
        default:
            echo "<p>Вторым аргументом функция принимает: '+', '-', '/', '*'</p>";
            return true;
    }

    echo "<h2>Результат: $totalNum</h2>";
    return true;
}

function task3(){
    $operator = null;
    $arr = array();
    foreach (func_get_args() as $index =>$value) {
        if ($index == 0) {
            $operator = $value;
            continue;
        }
        $arr[] = $value;
    }
    $result = null;
    switch($operator) {
        case '+':
            foreach ($arr as $value) {
                if ($result == null) {
                    $result = $value;
                    continue;
                }
                $result += $value;
            }
            break;
        case '-':
            foreach ($arr as $value) {
                if ($result == null) {
                    $result = $value;
                    continue;
                }
                $result -= $value;
            }
            break;
        case '/':
            foreach ($arr as $value) {
                if ($result == null) {
                    $result = $value;
                    continue;
                }
                $result /= $value;
            }
            break;
        case '*':
            foreach ($arr as $value) {
                if ($result == null) {
                    $result = $value;
                    continue;
                }
                $result *= $value;
            }
            break;
        default:
            echo "<h2>Математический оператор введен неверно.</h2>";
            return true;
    }
    echo "<h2>Результат: $result</h2>";
    return true;
}

function task4($column, $row) {
    if (!is_int($column) || !is_int($row)) {
        echo "<h2>Аргументы функции должны быть целыми числами.</h2>";
        return true;
    } elseif(($column < 1 || $column > 10) || ($row < 1 || $row > 10)) {
        echo "<h2>Число аргументов должно быть от 1 до 10.</h2>";
        return true;
    }
    $i = 1;
    echo "<table>";
    while ($i <= $row) {
        echo "<tr>";
        $i_col = 1;
        while ($i_col <= $column) {
            $inner_num = $i * $i_col;
            echo "<td>$inner_num</td>";
            $i_col++;
        }
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    return true;
}

function task5func1($str) {
    $lowerStr = strtolower($str);
    $strArr = array();
    for($i = 0; $i < strlen($lowerStr); $i++){
        if ($lowerStr[$i] == ' ') continue;
        $strArr[] = $lowerStr[$i];
    }
    $countArr = count($strArr);
    $i = 0;
    while ($i < ($countArr - $countArr%2)/2) {
        if ($strArr[$i] != $strArr[$countArr-$i-1]) {
            return false;
        };
        $i++;
    }
    return true;
}
function task5func2($str) {
    $getResult = task5func1($str);
    if ($getResult) {
        echo "<h2>Строка является палиндромом.</h2>";
    } else {
        echo "<h2>Строка не является палиндромом.</h2>";
    }
    return true;
}