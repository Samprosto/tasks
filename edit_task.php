<?php
session_start();
$id = $_GET['edit_btn'];
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

$sort_type = $_GET['sort'];
$page = $_GET['page'];
$sort_type2 = $_GET['sort2'];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Редактирование задачи</title>
      
      
  </head>
    
    <body class="bg-dark">
    <nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand" href="#">
		<img src="ic/task.png" class="d-inline-block align-top" width="50" height="50">
        <h1 style="float: right" >Редактирование задачи</h1>
	</a>
        
        <?php
            if ($_SESSION['admin'] == 'admin'){   
                echo '<p><a class="text-white">Вы вошли в как: Admin</a>';
            } else {
                echo '<p>';
            }
        ?>
        
            <a class="btn btn-danger btn-lg" href="index_admin.php">Назад</a></p>
        
</nav>
        <?php 
            
            if (isset($_POST['text'])){
                $text = $_POST['text'];
                
                $sql = "UPDATE tasks_list SET text='$text' WHERE id='$id'";
                
                $result = mysqli_query($link, $sql);
                
                header("Location: index_admin.php?page=$page&sort=$sort_type&sort2=$sort_type2");
                    
            }
        ?>
        
<form style="margin-left: 30%; margin-right: 30%; margin-top: 10%;" method="post">
    <div class="form-group">
    <label class="text-white" for="InputText">Текст задачи</label>
        <textarea type="text" class="form-control" id="InputText" placeholder="Введите отредактированный текст задачи" name="text"><?php
            $settext = "SELECT text FROM tasks_list WHERE id='$id'";
            $res = mysqli_query($link, $settext);
            $text = mysqli_fetch_assoc($res);
            echo $text[text]; 
            ?>
        </textarea>
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