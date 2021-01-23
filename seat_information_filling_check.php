<?php
	session_start();
    $title = "Seat Information Filling Check";
    include_once 'header.php';
	include_once 'db_info.php';
	
	$trainno = trim($_REQUEST['trainno']);
	$source = strtoupper(trim($_REQUEST['source']));
	$destination = strtoupper(trim($_REQUEST['destination']));
	$date = trim($_REQUEST['date']);
	$sleeper_fare = trim($_REQUEST['sleeper_fare']);
	$ac1_fare = trim($_REQUEST['ac1_fare']);
	$ac2_fare = trim($_REQUEST['ac2_fare']);
	$ac3_fare = trim($_REQUEST['ac3_fare']);
	
	$q = "INSERT INTO seatAvailability (trainno, source, destination, date, sleeper_seat, ac1_seat, ac2_seat, ac3_seat, sleeper_fare, ac1_fare,ac2_fare,ac3_fare) VALUES ('$trainno','$source', '$destination', '$date','864','72','72','72', '$sleeper_fare', '$ac1_fare', '$ac2_fare', '$ac3_fare')";
	$result = mysqli_query($db_conn,$q);
	if($result)
	{
		echo '<div class="content">
	                <h4 class="text-center">Record Inserted Successfully.</h4></div>';
	}
	else
	{
		echo '<div class="content">
	                <h4 class="text-center">'."Record not inserted due to " . mysqli_error($db_conn).'</h4></div>';
	}
	
	mysqli_close($db_conn);
    include_once 'footer.php';
?>