<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
    $title = "Reset Password Form";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
			<h2 class="text-center">Reset Password</h2>
		<form action="reset_password_check.php" method="POST" name="reset_password_form" onsubmit="return validateForm()">
                <div class="form-group">
                    <input type="email" id="rst_email" name="rst_email" class="form-control" placeholder="Email"/>                    
                </div>
                <button type="submit" class="btn btn-primary pull-right">Forgot Password</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" language="JavaScript">
    function validateForm()
    {
        var rst_email = document.reset_password_form.rst_email.value;
        
        if(rst_email == "")
        {
            alert("Please enter your email");
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