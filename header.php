<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?> </title>
        <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="ORS.css" rel="stylesheet" type = "text/css"/>
        <script src="Bootstrap/js/jquery.js"></script>
		<script src="Bootstrap/js/bootstrap.min.js"></script>		
		<script src="ORS.js" type="text/javascript"></script>	
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class="wrapper">
    		<nav class="nav navbar-inverse">
            	<div class="navbar-header">
            		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#index">
            			<span class="icon-bar"></span>
            			<span class="icon-bar"></span>
            			<span class="icon-bar"></span>
            		</button>
            		<a href="https://www.bccfalna.com/rm/OMS/" class="navbar-brand">Train Reservation</a>
            	</div>
            	<div class="collapse navbar-collapse" id="index">
            		<ul class="nav navbar-nav">
            		    <li><a href="pnr_status_form.php">PNR Status</a></li>
            			<?php 
            				if(isset($_SESSION['login']))
            				{
            					echo '<li><a href="my_account.php">My Account</a></li>';
            					echo '<li><a href="book_ticket_form.php">Ticket Booking</a></li>';
            					echo '<li><a href="seat_available_form.php">Seat Availability</a></li>';
            					if(isset($_SESSION['admin']))
                    			{
                    			    echo '<li><a href="pnr_ticket_cancel_form.php">Ticket Cancelation</a></li>';
                    			    echo '<li><a href="chart_prepare_form.php">Chart Prepare</a></li>';
                    			}
                    			echo '<li><a href="logout.php" name="logout">Logout</a></li>';
            				}
            				else
            				{
            				    echo '<li><a href="login_form.php">Login</a></li>';
            				}
            			?>
            		</ul>
            	</div>
            </nav>