<?php
	session_start();
    $title = "Ticket Availability Check";
    include_once 'header.php';
    include_once 'navbar_header.php';
	include_once 'db_info.php';
	
	$trainno = strtoupper(trim($_REQUEST['trainno']));
	$source = strtoupper(trim($_REQUEST['source']));
	$destination = strtoupper(trim($_REQUEST['destination']));
	$class = trim($_REQUEST['class']);
	$date = trim($_REQUEST['date']);
	
	$q = "SELECT sleeper_seat, ac1_seat, ac2_seat, ac3_seat, sleeper_fare, ac1_fare, ac2_fare, ac3_fare FROM seatAvailability WHERE trainno = '$trainno' AND date = '$date' AND source = '$source' AND destination = '$destination'";
    $result = mysqli_query($db_conn, $q);
	$count = mysqli_num_rows($result);
	if($count > 0)
	{
		$row = $result->fetch_row();	
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
			<h2 class="text-center">Seat Availability</h2>
			<table class="table table-bordered">
				<tr><th>Train No</th><td><?php echo $trainno;?></td></tr>
				<tr><th>Source</th><td><?php echo $source;?></td></tr>
				<tr><th>Destination</th><td><?php echo $destination;?></td></tr>
				<tr><th>Date</th><td><?php echo $date;?></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr><th>Availability</th>
				<td>
						<table class="table table-bordered">
							<tr><th>SLEEPER</th><th>AC1</th><th>AC2</th><th>AC3</th></tr>
							<tr><?php 
								for($i=0; $i<=3; $i++)
								{?><td>
									<?php
										$seat = $row[$i];
										if($seat > 0)
										{
											echo "Available " . $seat;
										}
										else
										{
											echo "Waiting " . abs($seat);
										}
									?>
										</td><?php } ?>
						</table>
					</td></tr>
				<tr><th>Fare</th><td>
						<table class="table table-bordered">
							<tr><th>SLEEPER</th><th>AC1</th><th>AC2</th><th>AC3</th></tr>
							<tr>
								<?php 
								for(;$i<=7; $i++)
								{?><td>
									<?php
										$fare = $row[$i];
										echo "RS." . $fare;
									?>
										</td><?php } ?>
							</tr>
						</table>
					</td></tr>
			</table>
			<a href="book_ticket_form.php" name="book_ticket" class="btn btn-primary pull-right">Book Ticket Now</a>
		</div>
	</div>
</div>
<?php
	}
	else
	{
		echo '<div class="content">
	            <h4 class="text-center">No Data Found</h4>
	        </div>';
	}
    mysqli_close($db_conn);
	include_once 'navbar_footer.php';
    include_once 'footer.php';
?>