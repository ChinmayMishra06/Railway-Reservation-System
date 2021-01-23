<?php
	session_start();
	$title = "Logout";
	
	include_once 'header.php';
	
	if(isset($_SESSION['login']))
	{
	    unset($_SESSION['login']);
	    if(isset($_SESSION['admin']))
	    {
	        unset($_SESSION['admin']);
	    }
	}
?>
<form action="login_form.php" method="POST" id="logout">
    <input type="hidden" name="logout" value="You are logout successfully."/>
</form>
<script type="text/JavaScript" language="JavaScript">
    document.getElementById('logout').submit();
</script>
<?php
	include_once 'footer.php';
?>