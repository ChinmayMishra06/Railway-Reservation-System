<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
        $title = "Reset Password Check";
        include_once 'header.php';
        include_once 'db_info.php';
        
        $email = trim($_REQUEST['rst_email']);
    	
        $q = "SELECT email FROM `user` WHERE email = '$email'";
        $result = mysqli_query($db_conn, $q);
        $row = $result->fetch_row();
    
        if($row[0] === $email)
        {
            $message = "To reset your password! Please click the link https://www.bccfalna.com/rm/OMS/new_password_form.php?mail=$email";
            
            if(mail($email,"Reset Password", $message, "DoNotReply"))
            {
                echo '<div class="content">
	                <h4 class="text-center">Check your mail account for reset password.</h4></div>';
            }
            else
            {
                echo '<div class="content">
	                <h4 class="text-center">Mail not sent.</h4></div>';
            }
        }
        else
        {
             echo '<div class="content">
	                <h4 class="text-center">User does not exist. Please Register...</h4></div>';
             header("refresh:2; url=https://www.bccfalna.com/rm/OMS/registration_form.php");
        }
    	mysqli_close($db_conn);
        include_once 'footer.php';
	}
	
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/");
	}
?>