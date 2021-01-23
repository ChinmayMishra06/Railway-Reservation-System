<?php
    define('db_host', 'localhost');
    define('db_user', 'bccfalna_rm');
    define('db_pass', 'password@123');
    define('db', 'bccfalna_rm');
    
    $db_conn = mysqli_connect(db_host, db_user, db_pass, db) OR 
    die('could not connect with database');
?>