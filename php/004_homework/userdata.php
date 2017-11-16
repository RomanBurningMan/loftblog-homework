<?php
/**
* Created by PhpStorm.
* User: пользователь
* Date: 12.11.2017
* Time: 12:50
*/
session_start();
if ($_SESSION['auth'] == 1) {
    require_once "./db.php";
    $uploadFile = $_FILES['photo'];
    $userDataArr = array(
        'username' => strip_tags($_POST['username']),
        'birthday' => strip_tags($_POST['birthday']),
        'selfinfo' => strip_tags($_POST['selfinfo']),
        'filepath' => './upload/'.$uploadFile['name'],
        'login' => $_SESSION['login']
    );
    if (!empty($userDataArr['username']) && !empty($userDataArr['birthday'])
        && !empty($userDataArr['selfinfo'] && !empty($uploadFile))) {
        $fileExtension = strtolower(pathinfo($uploadFile['name'],PATHINFO_EXTENSION));
        $validExtension = ['jpg','png','gif','jpeg'];
        $separateExtension = explode('/',$uploadFile['type']);

        if (!in_array($fileExtension,$validExtension) ||
            !in_array('image',$separateExtension)) die("<h2>Ошибка: Добавьте изображение с расширением jpg, png, gif, jpeg.</h2>");

        if ($uploadFile['error'] !== UPLOAD_ERR_OK) die("<h2>Ошибка загрузки файла.</h2>");

        $uploadMaxSize = fileSizeCount(ini_get('upload_max_filesize'));
        $postMaxSize = fileSizeCount(ini_get('post_max_size'));
        if ($uploadFile['size'] == 0) {
            die("<h2>Файл пустой.</h2>");
        } elseif ($uploadFile['size'] > $uploadMaxSize || $uploadFile['size'] > $postMaxSize) {
            die("<h2>Загрузите файл меншего размера.</h2>");
        }

        copy($uploadFile['tmp_name'],$userDataArr['filepath']);

        try {
            $DBH = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $insertData = $DBH->prepare("
                    UPDATE
                      users
                    SET
                      user_name = :username, age = :birthday, description = :selfinfo, photo = :filepath
                    WHERE
                      login = :login;
                ");
            $insertData->execute($userDataArr);

        } catch (PDOException $e) {
            file_put_contents('./log/PDOErrorsAditionalInfo.txt',date('Y-m-d H:i').' [Error] '.$e->getMessage()."\r\n",FILE_APPEND);
        }
    } else {
        echo "<h2>Заполните все поля формы.</h2>";
    }
    unset($_POST['username']);
    unset($_POST['birthday']);
    unset($_POST['selfinfo']);
} else {
    header("Location: ".$_SERVER['HTTP_REFERER']);
};

function fileSizeCount($size) {
    $size = strtoupper(trim($size));
    $length = strlen($size) - 1;

    switch ($size[$length])
    {
        case 'G':
            $size *= 1024;
        case 'M':
            $size *= 1024;
        case 'K':
            $size *= 1024;
    }
    return $size;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="list.php">Список пользователей</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
                <li class="active"><a href="userdata.php">Данные пользователя</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="form-container">
        <form class="form-horizontal" action="./userdata.php" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="userName" class="col-sm-2 control-label">Ваше имя:</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="userName" maxlength="50" placeholder="Имя">
                </div>
            </div>
            <div class="form-group">
                <label for="birthday" class="col-sm-2 control-label">День рождения:</label>
                <div class="col-sm-10">
                    <input type="date" name="birthday" class="form-control" id="birthday" placeholder="День рождения" min="1920-01-01" max="2020-12-31">
                </div>
            </div>
            <div class="form-group">
                <label for="selfInfo" class="col-sm-2 control-label">О себе:</label>
                <div class="col-sm-10">
                    <textarea name="selfinfo" id="selfInfo" rows="5" maxlength="1200" style="width: 100%" placeholder="Информация о себе..."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="photo" class="col-sm-2 control-label">Фото:</label>
                <div class="col-sm-10">
                    <input type="file" name="photo" id="photo" placeholder="Ваше фото">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Отправить</button>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

