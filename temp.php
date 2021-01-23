<?php
	session_start();
    $title = "Temp";
    include_once 'header.php';
    
    echo $_SESSION['login'];
    echo $_SESSION['admin'];

    include_once 'footer.php';
?>