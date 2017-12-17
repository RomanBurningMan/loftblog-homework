<?php
session_start();
if ($_SESSION['auth'] == 1) {
    require_once "./db.php";
    try
    {
        $idForDelete = (int) $_GET['deletePhoto'];

        if (empty($idForDelete))
        {
            throw new Exception('id для удаление не определено.');
        }
    }
    catch (Exception $e)
    {
        echo "<pre>";
        print_r($e->getMessage());
        echo "</pre>";
        $idForDelete = NULL;
    }
    try {
        $DBH = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        if (!empty($idForDelete) && $idForDelete > 2) {
            $filePath = $DBH->prepare("
                SELECT
                  photo
                FROM
                  users
                WHERE
                  id = :id;
            ");
            $filePath->bindParam(':id',$idForDelete);
            $filePath->execute();
            $getFilePath = $filePath->fetchAll(PDO::FETCH_ASSOC);
            unlink($getFilePath[0]['photo']);

            $deletePhoto = $DBH->prepare("
                UPDATE 
                  users
                SET
                  photo = null
                WHERE
                  id = :id;
            ");
            $deletePhoto->bindParam(':id',$idForDelete);
            $deletePhoto->execute();
            header("Location: ./filelist.php");
        }
        $selectUsers = $DBH->prepare("
            SELECT
              id, photo
            FROM
              users;
        ");
        $selectUsers->execute();
        $result = $selectUsers->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        file_put_contents('./log/PDOErrorsPhotoList.txt',date('Y-m-d H:i').' [Error] '.$e->getMessage()."\r\n",FILE_APPEND);
    }
} else {
    header("Location: ".$_SERVER['HTTP_REFERER']);
};
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
            <li class="active"><a href="filelist.php">Список файлов</a></li>
            <li><a href="userdata.php">Данные пользователя</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
      <h2>Информация выводится из списка файлов</h2>
      <table class="table table-bordered">
        <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
      <?php
        if (!empty($result)) {
            $i = 1;
            foreach($result as $groupValue) {
                if (empty($groupValue['photo'])) continue;
                $fileName = basename($groupValue['photo']);

                echo "<tr><td>$i. $fileName</td>";
                echo "<td><img src='".$groupValue['photo']."' alt=''></td>";
                echo "<td><a href='./filelist.php?deletePhoto=".$groupValue['id']."'>Удалить аватарку пользователя</a></td></tr>";
                $i++;
            }
        }
      ?>
      </table>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
