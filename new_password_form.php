<?php
    session_start();
	if(!isset($_SESSION['login']))
	{
    $title = "New Password Form";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
			<h2 class="text-center">New Password</h2>
            <form action="new_password_check.php" method="POST" name="new_password_form" onsubmit="return validateForm()">
                <div class="form-group">
                    <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Password"/>                    
                </div>
                <div class="form-group">
                    <input type="password" id="new_conpass" name="new_conpass" class="form-control" placeholder="Confirm Password"/>                    
                </div>
                <div class="form-group">
                    <input type="hidden" name="hidden_mail" value="<?php echo $_REQUEST['mail'];?>"/>                    
                </div>
                <button type="submit" class="btn btn-primary pull-right">Change Password</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" language="JavaScript">
	function validateForm()
	{
		var password = document.new_password_form.new_pass.value;
		var confirm_password = document.new_password_form.new_conpass.value;
		
		if(password == "")
		{
			alert("Please enter password");
			return false;
		}
		if(confirm_password == "")
		{
			alert("Please enter confirm password");
			return false;
		}
		
		if(password != confirm_password)
		{
			alert("Confirm password does not math with password");
			return false;
		}
	}
</script>
<?php
    include_once 'footer.php';
    }
	
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/");
	}		
?>