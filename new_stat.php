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

if ($_SESSION['admin'] !== 'admin'){
    header("Location: index_admin.php");
}

$id = $_GET['stat_btn'];
$stat = $_GET['stat'];
$sort_type = $_GET['sort'];
$page = $_GET['page'];
$sort_type2 = $_GET['sort2'];

if ($stat == 0){
    $stat = 1;
    $st_ch = "UPDATE tasks_list SET status='$stat' WHERE id='$id'";
    $res_stat = mysqli_query($link, $st_ch);
    header("Location: index_admin.php?page=$page&sort=$sort_type&sort2=$sort_type2");
}else{
    $stat = 0;
    $st_ch = "UPDATE tasks_list SET status='$stat' WHERE id='$id'";
    $res_stat = mysqli_query($link, $st_ch);
    header("Location: index_admin.php?page=$page&sort=$sort_type&sort2=$sort_type2");
}


?>