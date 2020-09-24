<?php 
    if($_COOKIE['admin'] == 'admin')
        setcookie('admin','admin',time()-3600,'/');
    else
        setcookie('admin','admin',time()+3600,'/');

    header('Location: index_admin.php');
?>