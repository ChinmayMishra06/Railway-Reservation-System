<?php	
    $title = "Registration Form";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
            <h2 class="text-center">Registration</h2>
            <form action="registration_check.php" method="POST" role="form" name="registeration_form" onSubmit="return validateForm()">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>        
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>        
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Register</button>
            </form>
        </div>                            
    </div>
</div>
<script type="text/javascript" language="JavaScript">
    function validateForm()
    {
        var name = document.registeration_form.name.value;
        var email = document.registeration_form.email.value;
        var password = document.registeration_form.password.value;
        var conpassword = document.registeration_form.conpassword.value;
        
        if(name == "")
        {
            alert("Please enter your name");
            return false;
        }
        if(email == "")
        {
            alert("Please enter your email");
            return false;
        }
        if(password == "")
        {
            alert("Please enter your password");
            return false;
        }
        if(conpassword == "")
        {
            alert("Please enter your confirm password");
            return false;
        }
        if(conpassword != "")
        {
            if(password != conpassword)
            {
                alert("Confirm password does not match with password");
            return false;
            }
        }
    }
</script>
<?php
    include_once 'footer.php';
?>