<?php
	session_start();
    if(!isset($_SESSION['login']))
	{
		$title = "Login Form";
		include_once 'header.php';
		$logout = $_REQUEST['logout'];
	?>
	<h4 class="text-center id="logout"><?php echo $logout;?></h4>
	<div class="container content">
        <div class="row centering">
            <div class="well">
        		<h2 class="text-center">Login</h2>
        		<form action="login_check.php" method="POST" role="form" name="login_form" onSubmit="return validateForm()">
        			<div class="form-group">
        				<input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email">
        			</div>        
        			<div class="form-group">
        				<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
        			</div>
        			<button type="submit" class="btn btn-primary pull-right">Login</button>
        			<a href="registration_form.php">Register?</a><br/><a href="reset_password_form.php">Lost Password?</a>
        		</form>
            </div>
        </div> 
    </div>
	<script type="text/javascript" language="JavaScript">
	    jQuery('h4').fadeOut(10000);
		function validateForm()
		{
			var user_email = document.login_form.user_email.value;
			var user_password = document.login_form.user_password.value;
			
			if(user_email == "")
			{
				alert("Please enter your email");
				return false;
			}
			if(user_password == "")
			{
				alert("Please enter your password");
				return false;
			}
		}
	</script>
	<?php
		include_once 'footer.php';
	}
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/login_form.php");
	}
?>