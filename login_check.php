<?php
	session_start();
    $title = "Login Check";
    include_once 'header.php';
    include_once 'db_info.php';
    
    $email = trim($_REQUEST['user_email']);
    $password = SHA1(trim($_REQUEST['user_password']));
    
    $q1 = "SELECT password, status FROM user WHERE email = '$email'";
    $result1 = mysqli_query($db_conn, $q1);
	$count1 = mysqli_num_rows($result1);

	if($count1 > 0)
	{
		$row1 = $result1->fetch_row();    
		
		if($password === $row1[0])
		{
		    if(1 == $row1[1] )
		    {
    			$_SESSION['login'] = $email;
    			
    			$q2 = "SELECT role FROM user WHERE email = '$email'";
    			$result2 = mysqli_query($db_conn, $q2);
    			
    			$row2 = $result2->fetch_row();			
    			
    			if($row2[0] === 'admin')
    			{				
    				$_SESSION['admin'] = 'admin';
    			}
    			header("Location: https://www.bccfalna.com/rm/OMS/pnr_status_form.php");
		    }
		    else
		    {
		        echo '<div class="content">
	                <h4 class="text-center">Please confirm your email.</h4>
	            </div>';
		    }
		}
		
		else
		{
			echo '<div class="content">
	                <h4 class="text-center">Password is wrong.</h4></div>';
			header("refresh:2; url=https://www.bccfalna.com/rm/OMS/login_form.php");
		}
	}
	
	else
	{
		echo '<div class="content">
	                <h4 class="text-center">User does not exist.</h4></div>';
		header("refresh:2; url=https://www.bccfalna.com/rm/OMS/registration_form.php");
	}

    mysqli_close($db_conn);
    include_once 'footer.php';
?>