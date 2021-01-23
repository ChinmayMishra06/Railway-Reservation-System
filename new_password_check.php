<?php
    session_start();
	if(!isset($_SESSION['login']))
	{
    $title = "New Password Check";
    include_once 'header.php';
    
    $new_pass= trim($_REQUEST['new_pass']);
    $con_pass= trim($_REQUEST['new_conpass']);
    $email = trim($_REQUEST['hidden_mail']);
	
    if($new_pass === $con_pass)
    {
       include_once 'db_info.php';
        $q = "UPDATE user SET password = SHA1('$new_pass') WHERE email = '$email'";
        if($result = mysqli_query($db_conn,$q))
        {
            echo '<div class="content">
	                <h4 class="text-center">Password changed successfully. Please do not press refresh button or back button you are redircting on login form.</h4></div>';
            header('refresh: 5; url=https://www.bccfalna.com/rm/OMS/login_form.php');
        }    
        else
        {
            echo '<div class="content">
	                <h4 class="text-center">'. "Password not changed due to " . mysqli_errno($db_conn) . '</h4></div>';
        }        
    }
    else
    {
        echo '<div class="content">
	                <h4 class="text-center">Confirm password does not match with new password.</h4></div>';
    }        
    mysqli_close($db_conn);
    include_once 'footer.php';
     }
	
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/");
	}
	
?>