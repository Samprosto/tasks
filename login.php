<?php
session_start();
$user = 'admin';
$pass = '123';
 if($_POST['log_in']){
 if($user == $_POST['user'] AND $pass == $_POST['pass'])
{
 $_SESSION['admin'] = $user;
 header("Location: index_admin.php");
 exit;
 }
else{
    echo '<script language="javascript">';
    echo 'alert("Логин или пароль не верны")';
    echo '</script>';
}
} 
?>  

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Авторизация</title>
      
      
  </head>
    
    <body class="bg-dark">
    <nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand" href="#">
		<img src="ic/task.png" class="d-inline-block align-top" width="50" height="50">
        <h1 style="float: right" >Авторизация</h1>
	</a>
        <p><a class="btn btn-danger btn-lg" href="index.php">Назад</a></p>
</nav>
        
<form style="margin-left: 30%; margin-right: 30%; margin-top: 10%;" method="post">
  <div class="form-group">
    <label class="text-white" for="InputLogin">Имя пользователя</label>
    <input type="text" class="form-control" id="InputLogin" placeholder="Введите имя пользователя" name="user">
  </div>
  <div class="form-group">
    <label class="text-white" for="InputPassword">Пароль</label>
    <input type="password" class="form-control" id="InputPassword" placeholder="Введите пароль" name="pass">
  </div>
  <input type="submit" class="btn btn-success" name="log_in" value="Войти"/>
</form>
        
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>