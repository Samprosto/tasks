<?php
session_start();
if($_GET['do'] == 'logout'){
 unset($_SESSION['admin']);
 session_destroy();
} 

$link = mysqli_connect("127.0.0.1:3306", "beejeesql", "BeeJeesql2020", "prostosam");

if (mysqli_connect_error()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

if ($_SESSION['admin'] == 'admin'){
    header("Location: index_admin.php");
}

$sort_type = $_GET['sort'];
$sort_type2 = $_GET['sort2'];


$num = 3;

$page = $_GET['page'];

$result = mysqli_query($link, "SELECT COUNT(*) FROM `tasks_list`");
$res_array = mysqli_fetch_row($result);
$posts = $res_array[0];

$total = intval(($posts - 1) / $num) + 1;

$page = intval($page);

if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;

$start = $page * $num - $num;
mysqli_free_result($result);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      <link rel="stylesheet" href="page.css">
    <title>Задачи</title>
      
      
  </head>
  <body class="bg-dark">
    <nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand" href="#">
		<img src="ic/task.png" class="d-inline-block align-top" width="50" height="50">
        <h1 style="float: right" >Задачи</h1>
	</a>
        
        <?php
            if($_SESSION['admin'] == 'admin'):
        ?>
        <p>
        <a class="text-white">Вы вошли в как: Admin</a>
            <a class="btn btn-danger btn-lg" href="index.php?do=logout">Выход</a></p>
        <?php else: ?>
        <p><a class="btn btn-success btn-lg" href="login.php">Вход</a></p>
        <?php endif; ?>
</nav>
      
      <nav aria-label="Sort" style="margin-top: 1%">
          
    <ul class="pagination justify-content-center">
       
        <li class="page-item"><a class="page-link" href="new_task.php">Новая задача</a></li>
        <li class="page-item disabled"><a class="page-link">Сортировка :</a></li>
        <?php
        if($sort_type!=2 && $sort_type!=3 && $sort_type!=4){
        echo'<li class="page-item active"><a class="page-link" href= ./index.php?page='.$page.'&sort=1&sort2='.$sort_type2.'>По дате добавления</a></li>';
        }else{
            echo'<li class="page-item"><a class="page-link" href= ./index.php?page='.$page.'&sort=1&sort2='.$sort_type2.'>По дате добавления</a></li>';
        }
        
        if($sort_type == 2){
            echo'<li class="page-item active"><a class="page-link" href= ./index.php?page='.$page.'&sort=2&sort2='.$sort_type2.'>По имени пользователя</a></li>';
        }else{
            echo'<li class="page-item"><a class="page-link" href= ./index.php?page='.$page.'&sort=2&sort2='.$sort_type2.'>По имени пользователя</a></li>';
        }
        
        if($sort_type == 3){
            echo'<li class="page-item active"><a class="page-link" href= ./index.php?page='.$page.'&sort=3&sort2='.$sort_type2.'>По email</a></li>'; 
        }else{
            echo'<li class="page-item"><a class="page-link" href= ./index.php?page='.$page.'&sort=3&sort2='.$sort_type2.'>По email</a></li>';
        }
        
        if($sort_type == 4){
            echo'<li class="page-item active"><a class="page-link" href= ./index.php?page='.$page.'&sort=4&sort2='.$sort_type2.'>По статусу</a></li>';
        }else{
            echo'<li class="page-item"><a class="page-link" href= ./index.php?page='.$page.'&sort=4&sort2='.$sort_type2.'>По статусу</a></li>';
        }
        
        echo '</ul>';
        echo '<ul class="pagination justify-content-center">';
        if($sort_type2!=2){
            echo'<li class="page-item active"><a class="page-link" href= ./index.php?page='.$page.'&sort='.$sort_type.'&sort2=1>По возростанию</a></li>';
        }else{
            echo'<li class="page-item"><a class="page-link" href= ./index.php?page='.$page.'&sort='.$sort_type.'&sort2=1>По возростанию</a></li>';
        }
        
        if($sort_type2 == 2){
            echo'<li class="page-item active"><a class="page-link" href= ./index.php?page='.$page.'&sort='.$sort_type.'&sort2=2>По убыванию</a></li>';
        }else{
            echo'<li class="page-item"><a class="page-link" href= ./index.php?page='.$page.'&sort='.$sort_type.'&sort2=2>По убыванию</a></li>';
        }
        
        ?>
    </ul>
      </nav>
      
      <?php
      if($sort_type == 4){
          $q1 = "SELECT * FROM `tasks_list` ORDER BY status";
      }elseif($sort_type == 3){
          $q1 = "SELECT * FROM `tasks_list` ORDER BY email";
      }elseif($sort_type == 2){
          $q1 = "SELECT * FROM `tasks_list` ORDER BY user_name";
      }else{
          $q1 = "SELECT * FROM `tasks_list` ORDER BY id";
      }
      
      if ($sort_type2 == 2){
          $q1 = $q1." DESC LIMIT $start, $num";
      }else{
          $q1 = $q1." ASC LIMIT $start, $num";
      }
        if ($result = mysqli_query($link, $q1)){

            while ( $test = mysqli_fetch_assoc($result)){
      echo '<div class="card mb-4 shadow-sm" style="margin: 1%; margin-left: 10%; margin-right: 10%">
        <div class="card-header bg-success text-white">
            <table style="width:  100%; border-spacing: 0">
                <tr>
                    <td style="width: 50%"><h4 class="my-0 font-weigh-normal">'.$test[user_name].'</h4></td>
                    <td style="text-align: right"><h4 class="my-0 font-weigh-normal">'.$test[email].'</h4></td>
                </tr>
            </table>
        </div>
          <div class="card-body" style="padding: 10px">
          <table style="width:  100%; border-spacing: 0">
            <tr>
                <td rowspan="2" style="width: 80%"><h5 class="card-title pricing-card-title">'.$test[text].'</h5></td>
                <td style="text-align: center"><h5>Статус выполнения</h5></td>
            </tr>
            <tr>
                
                <td style="text-align: center">';
          if ($test[status] == 0){
                echo '<img src="ic/cross.png" class="d-inline-block align-top" width="50" height="50">';
          } else {
                echo '<img src="ic/check.png" class="d-inline-block align-top" width="50" height="50">';  
          }
          
          echo '</td>
            </tr>
          </table>
          </div>
      </div>';
            }
            mysqli_free_result($result);
        }
      ?>
      
      
      <?php

        if ($page != 1){ $pervpage = '<li class="page-item"><a class="page-link" href= ./index.php?page=1&sort='.$sort_type.'&sort2='.$sort_type2.'>Первая</a></li>
                                       <li class="page-item"><a class="page-link" href= ./index.php?page='. ($page - 1) .'&sort='.$sort_type.'&sort2='.$sort_type2.'><<</a></li> ';
                       }else{
            $pervpage = '<li class="page-item disabled"><a class="page-link" href= ./index.php?page=1>Первая</a></li>
                                       <li class="page-item disabled"><a class="page-link" href= ./index.php?page='. ($page - 1) .'&sort='.$sort_type.'&sort2='.$sort_type2.'><<</a></li> ';
        }

        if ($page != $total){ $nextpage = ' <li class="page-item"><a class="page-link" href= ./index.php?page='. ($page + 1) .'&sort='.$sort_type.'&sort2='.$sort_type2.'>>></a></li>
                                           <li class="page-item"><a class="page-link" href= ./index.php?page=' .$total. '&sort='.$sort_type.'&sort2='.$sort_type2.'>Последняя</a></li>';
                            }else{
            $nextpage = ' <li class="page-item disabled"><a class="page-link" href= ./index.php?page='. ($page + 1) .'&sort='.$sort_type.'&sort2='.$sort_type2.'>>></a></li>
                                           <li class="page-item disabled"><a class="page-link" href= ./index.php?page=' .$total. '&sort='.$sort_type.'&sort2='.$sort_type2.'>Последняя</a></li>';
        }


        if($page - 2 > 0) $page2left = ' <li class="page-item"><a class="page-link" href= ./index.php?page='. ($page - 2) .'&sort='.$sort_type.'&sort2='.$sort_type2.'>'. ($page - 2) .'</a></li>';
        if($page - 1 > 0) $page1left = '<li class="page-item"><a class="page-link" href= ./index.php?page='. ($page - 1) .'&sort='.$sort_type.'&sort2='.$sort_type2.'>'. ($page - 1) .'</a></li>';
        if($page + 2 <= $total) $page2right = '<li class="page-item"><a class="page-link" href= ./index.php?page='. ($page + 2) .'&sort='.$sort_type.'&sort2='.$sort_type2.'>'. ($page + 2) .'</a></li>';
        if($page + 1 <= $total) $page1right = '<li class="page-item"><a class="page-link" href= ./index.php?page='. ($page + 1) .'&sort='.$sort_type.'&sort2='.$sort_type2.'>'. ($page + 1) .'</a></li>';

        $thispage = '<li class="page-item active"><a class="page-link">'. $page .'</a></li>';


        echo 
           '<nav aria-label="Navigation" style="margin-top: 1%">
            <ul class="pagination justify-content-center">'.
        $pervpage.$page2left.$page1left.$thispage.$page1right.$page2right.$nextpage.
            '</ul>
        </nav>';

?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>