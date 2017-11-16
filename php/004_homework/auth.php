<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 07.11.2017
 * Time: 22:49
 */
require_once('./db.php');

// получаем имя файла по которому будет проводиться проверка страниц с которых возможна регистрация
$prevPage = $_SERVER['HTTP_REFERER'];
$prevPageArr = explode('/',$prevPage);
$lastELem = count($prevPageArr) - 1;

//header("Location: ".strtok($_SERVER['REQUEST_URI'],'?'));

$login = strip_tags($_POST['login']);
$auth = NULL;

//проверка страниц с которых можно авторизоваться
if ($prevPageArr[$lastELem] == 'reg.html') {
    $auth = signUp($host,$db_name,$user,$pass);
} elseif ($prevPageArr[$lastELem] == '' or $prevPageArr[$lastELem] == 'index.html') {
    $auth = signIn($host,$db_name,$user,$pass);
} else {
    echo "<h2>Перейдите на страницу авторизации!</h2>";
}

if ($auth) {
    session_start();
    $_SESSION['auth'] = 1;
    $_SESSION['login'] = $login;
    header("Location: ./userdata.php");
} else {
    echo "<p>Ошибка в авторизации.</p>";
}

function signUp($host,$db_name,$user,$pass) {
    $login = strip_tags($_POST['login']);
    $password1 = strip_tags($_POST['password1']);
    $password2 = strip_tags($_POST['password2']);
    $password = NULL;

    if ($password1 == $password2) {
        $password = password_hash($password1, PASSWORD_DEFAULT);
        $preparedArr = array(
            'login' => $login,
            'password' => $password,
            'username' => NULL,
            'age' => NULL,
            'description' => NULL,
            'photo' => NULL
        );
        $getSameLogin = addData($host,$db_name,$user,$pass,$preparedArr);
        if (is_array($getSameLogin)) {
            echo "<h2>Пользователь с логином <b>$login</b> уже зарегистрирован.</h2>";
            $finalResult = false;
        } else {
//            echo "<h2>Поздравляем, вы зарегистрированы!</h2>";
            $finalResult = true;
        }
    } else {
        echo "Неправильно продублирован пароль.";
        $finalResult = false;
    }
    return $finalResult;
}

function signIn($host,$db_name,$user,$pass) {
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $getPasswordDb = getData($host,$db_name,$user,$pass,$login);
    if ($getPasswordDb == '') {
        echo "Пара логин пароль введены неверно.";
        $finalResult = false;
    } elseif (password_verify($password,$getPasswordDb[0])) {
//        echo "<h2>Рады снова видеть вас!</h2>";
        $finalResult = true;
    }
    return $finalResult;
}

// добавление данных пользователя при регистрации
function addData($host,$db_name,$user,$pass,$queryArr) {
    try {
        $DBH = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $getSameLogin = $DBH->prepare("
            SELECT
              user_name
            FROM
              users
            WHERE
              login = :login;            
        ");
        $getSameLogin->bindParam(':login',$queryArr['login']);
        $getSameLogin->execute();
        $result = $getSameLogin->fetch();
        if (!is_array($result)) {
            $insertData = $DBH->prepare("
                INSERT INTO
                  users (login, password, user_name, age, description, photo)
                VALUES
                  (:login, :password, :username, :age, :description, :photo);            
            ");
            $insertData->execute($queryArr);
        }
    } catch (PDOException $e) {
        file_put_contents('./log/PDOErrorsAdd.txt',date('Y-m-d H:i').' [Error] '.$e->getMessage()."\r\n",FILE_APPEND);
    }
    return $result;
}

// проверка пары логин и пароль при авторизации
function getData($host,$db_name,$user,$pass,$login) {
    try {
        $DBH = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $query = $DBH->prepare("
            SELECT 
              password
            FROM
              users
            WHERE
              login = :login;            
        ");
        $query->bindParam(':login', $login);
        $query->execute();
        $result = $query->fetch();
    } catch (PDOException $e) {
        file_put_contents('./log/PDOErrorsGet.txt',date('Y-m-d H:i').' [Error] '.$e->getMessage()."\r\n",FILE_APPEND);
    }
    return $result;
}

echo " <a href='$prevPage'>Вернуться на предыдущую страницу</a>";