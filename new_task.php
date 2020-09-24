<?php
session_start();
if($_GET['do'] == 'logout'){
 unset($_SESSION['admin']);
 session_destroy();
} 

$link = mysqli_connect("127.0.0.1:3306", "beejeesql", "BeeJeesql2020", "prostosam");

/* проверка соединения */
if (mysqli_connect_error()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

$sql = "INSERT INTO tasks_list (user_name, email, text, status) VALUES (?, ?, ?, 0)";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Новая задача</title>
      
      
  </head>
    
    <body class="bg-dark">
    <nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand" href="#">
		<img src="ic/task.png" class="d-inline-block align-top" width="50" height="50">
        <h1 style="float: right" >Создание новой задачи</h1>
	</a>
        
        <?php
            if ($_SESSION['admin'] == 'admin'){   
                echo '<p><a class="text-white">Вы вошли в как: Admin</a>';
            } else {
                echo '<p>';
            }
        ?>
        
            <a class="btn btn-danger btn-lg" href="index.php">Назад</a></p>
        
</nav>
        <?php 
            if (isset($_POST['user']) && isset($_POST['email'])&& isset($_POST['text'])){
                $user = $_POST['user'];
                $email = $_POST['email'];
                $text = $_POST['text'];
                if(empty($user) || empty($email) || empty($text)){
                    echo '<script language="javascript">';
                    echo 'alert("Заполните все поля")';
                    echo '</script>';
                }elseif(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $sql = "INSERT INTO tasks_list (user_name, email, text, status) VALUES ('$user', '$email', '$text', 0)";
                $result = mysqli_query($link, $sql);
                header("Location: index.php");
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Email введён не верно")';
                    echo '</script>';
                }
                    
            }
        ?>
        
<form style="margin-left: 30%; margin-right: 30%; margin-top: 10%;" method="post">
  <div class="form-group">
    <label class="text-white" for="InputLogin">Имя</label>
    <input type="text" class="form-control" id="InputLogin" placeholder="Введите ваше имя" name="user">
  </div>
  <div class="form-group">
    <label class="text-white" for="InputText">Email</label>
    <input type="text" class="form-control" id="InputEmail" placeholder="Введите ваш email" name="email">
  </div>
    <div class="form-group">
    <label class="text-white" for="InputText">Текст задачи</label>
        <textarea type="text" class="form-control" id="InputText" placeholder="Введите текст задачи" name="text"></textarea>
  </div>
  <input type="submit" class="btn btn-success" name="submit" value="Отправить"/>
</form>
        
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>