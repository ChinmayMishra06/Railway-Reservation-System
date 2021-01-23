<?php 
	session_start();
    $title = "Online Reservation System";
    
    include_once 'header.php';
	
	if(isset($_SESSION['login']))
	{
        include_once 'pnr_status_form.php';
	}
    else
    {
        include_once 'login_form.php';
    }
    include_once 'footer.php';
?>
