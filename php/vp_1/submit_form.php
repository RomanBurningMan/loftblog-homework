<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 03.11.2017
 * Time: 22:54
 */
require_once('./db_data.php');
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
try {
    $DBH = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $DBH->prepare('SELECT * FROM catalog')->execute();
} catch (PDOException $e) {
    file_put_contents('./log/PDOErrors.txt',$e->getMessage(),FILE_APPEND);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница</title>
    <link rel="stylesheet" href="./css/vendors.min.css">
    <link rel="stylesheet" href="./css/main.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="maincontent">
            <section class="section">
                <div class="container">
                    <?php
                        if ($email == '') {
                            echo "<h2>Для авторизации, нам нужна ваша почта.</h2>
                            <form action='./submit_form.php' method='POST'>
                                <div><label>Введите эл. почту: <input type='email'></label></div>
                                <div><input type='submit' value='Заказать'></div>
                            </form>";
                            exit();
                        }
                        if ($name != '') echo "<p>Здравствуйте, $name</p>";
                        if ($email != '') echo "<p>Спасибо за заказ. Вся информация была выслана вам на эл. почту,".
                            " по адресу $email</p>";

                    ?>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
