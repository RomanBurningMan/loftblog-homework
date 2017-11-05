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
$phone = htmlspecialchars($_POST["phone"]);
$street = htmlspecialchars($_POST["street"]);
$house = htmlspecialchars($_POST["home"]);
$house_block = htmlspecialchars($_POST["part"]);
$apt = htmlspecialchars($_POST["appt"]);
$floor = htmlspecialchars($_POST["floor"]);
$comment = htmlspecialchars($_POST["comment"]);
$need_cashback = htmlspecialchars($_POST["payment"]);
$need_callback = htmlspecialchars($_POST["callback"]);

try {
    $DBH = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $prepareQuery = $DBH->prepare("SELECT id, user_email FROM users_login WHERE user_email = :email");
    $prepareQuery->bindParam(':email', $email);
    if ($prepareQuery->execute()) {
        $result = $prepareQuery->fetchAll();
        $customer_data = array(
            'phone' => $phone,
            'street' => $street,
            'house' => $house,
            'house_block' => $house_block,
            'apt' => $apt,
            'floor' => $floor,
            'comment' => $comment,
            'need_cashback' => $need_cashback,
            'need_callback' => $need_callback
        );
        $user_id = NULL;
        if (empty($result)) {
            $data = array(
                'user_name' => $name,
                'user_email' => $email
            );
            $userRegister = $DBH->prepare("INSERT INTO users_login (user_name, user_email)
                VALUE (:user_name, :user_email)");
            $userRegister->execute($data);
            $user_id = $DBH->lastInsertId();
        } else {
            $user_id = $result[0]['id'];
        }
        $addCustomerInfo = $DBH->prepare("INSERT INTO customer_data (user_id, tel, street,
            house, house_block, apt, floor, comments, need_cashback, need_callback) VALUE (
            $user_id, :phone, :street, :house, :house_block, :apt, :floor, :comment, :need_cashback, :need_callback)");
        $addCustomerInfo->execute($customer_data);
    }
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
