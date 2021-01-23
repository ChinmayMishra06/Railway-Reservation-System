<?php
	session_start();
    $title = "Registration Check";
    include_once 'header.php';
    include_once 'db_info.php';
	
    $statekey = rand(1,100);
    $username = trim($_REQUEST['name']);
    $email = trim($_REQUEST['email']);
    $password = SHA1(trim($_REQUEST['password']));
    
	$q = "INSERT INTO user (username, email, password, statekey) VALUES ('$username', '$email', '$password', '$statekey')";
    $result = mysqli_query($db_conn, $q);
    
    if($result)
    {
        $msg = "To confirm your email! Please click the link https://www.bccfalna.com/rm/OMS/email.php?confirm_code=$statekey";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers.= 'From: <support@bccfalna.com> '."\n";
        mail($email,"Register", $msg, $headers);
        echo '<div class="content">
	                <h4 class="text-center">Registration complete! Please confirm your email.</h4></div>';
    }
    else
    {
        echo '<div class="content">
	                <h4 class="text-center">'. "Record not inserted due to " . mysqli_error($db_conn).'</h4></div>';
    }
    mysqli_close($db_conn);
    include_once 'footer.php';
?>
