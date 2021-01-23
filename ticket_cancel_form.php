<?php
	session_start();
	if(isset($_SESSION['login']) && isset($_SESSION['admin']))
	{
		$title = "Ticket Cancel Form";
		include_once 'header.php';
	include_once 'db_info.php';
	$pnr = $_REQUEST['pnr'];
	
	$q1 = "SELECT * FROM trainBooking WHERE pnr = '$pnr' ";
	$result1 = mysqli_query($db_conn,$q1);
	$count1 = mysqli_num_rows($result1);
	
	if($count1 > 0)
	{
		$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
		$trainno = trim($row1['trainno']);
		$source = strtoupper(trim($row1['source']));
		$destination = strtoupper(trim($row1['destination']));
		$date = strtoupper(trim($row1['date']));
		$class = strtoupper(trim($row1['class']));
		
		$q2 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
		$result2 = mysqli_query($db_conn,$q2);
		$count2 = mysqli_num_rows($result2);
		$m=0;
		$f=0;
		$c=0;
		$total = 0;
		
		if($count2 > 0)
		{
			for($i=1; $i<=$count2; $i++)
			{
				$row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
				$age = $row2['age'];
				$sex = $row2['sex'];
				
				if($age > 5 && $sex == MALE)
				{
					$m++;
					$total++;
				}
				if($age > 5 && $sex == FEMALE)
				{
					$f++;
					$total++;
				}
				if($age < 5)
				{
					$c++;
					$total++;
				}
			}
		}
		else{ echo "No data found.";}
?>
<div class="container content">
	<div class="row">
        <div class="well frm-center">
            <table class="table table-bordered">
                <h2 class="text-center">Your Booking Details</h2>
				<tr><th>PNR Number</th><td><?php echo $pnr; ?></td></tr>
                <tr><th>Train Number</th><td><?php echo $trainno; ?></td></tr>
                <tr><th>Source</th><td><?php echo $source; ?></td></tr>
                <tr><th>Destination</th><td><?php echo $destination; ?></td></tr>
                <tr><th>Class</th><td><?php echo $class; ?></td></tr>
				<tr><th>Date</th><td><?php echo $date; ?></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
                <tr><th>No of Person</th>
                    <td>
                        <table class="table table-bordered">
                            <tr><th>Male</th><th>Female</th><th>Child</th><th>Total</th></tr>
							<tr><td><?php echo $m; ?></td><td><?php echo $f; ?></td><td><?php echo $c; ?></td><td><?php echo $total;?></td></tr>
                        </table>
                    </td>
                </tr>
				<tr><th>Passenger Details</th>
                    <td>
                        <table class="table table-bordered">
                            <tr><th>Name</th><th>Age</th><th>Sex</th><th>Seat Birth</th></tr>
							<?php
								$q3 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
								$result3 = mysqli_query($db_conn,$q3);
								$count3 = mysqli_num_rows($result3);?>
								<form action = "ticket_cancel_check.php" method="POST" name="ticket_cancel" id="ticketCancel" onSubmit="return ticket_cancel_check()">
									<input type="hidden" name="class" value="<?php echo $class;?>"/>
									<input type="hidden" name="pnr" value="<?php echo $pnr;?>"/>
									<input type="hidden" name="trainno" value="<?php echo $trainno;?>"/>
									<input type="hidden" name="source" value="<?php echo $source;?>"/>
									<input type="hidden" name="destination" value="<?php echo $destination;?>"/>
									<input type="hidden" name="date" value="<?php echo $date;?>"/>
									<input type="hidden" name="total" value="<?php echo $count2;?>"/>
								<?php
									$q4 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
									$result4 = mysqli_query($db_conn,$q4);
									$count4 = mysqli_num_rows($result4);
								for($i=1; $i<=$count4; $i++)
								{
									$cancel = "cancel$i";									
									if($count4 > 0)
									{
										$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
										?>
									<tr><tr><td><input type="checkbox" name="<?php echo $cancel;?>" value="<?php echo $row4['passenger_name'];?>"/><?php echo " " . $row4['passenger_name'];?></td><td><?php echo $row4['age'];?></td><td><?php echo $row4['sex'];
									}
									else
									{
										mysqli_error($db_conn);
									}
								?></td><td><?php echo $row4['status'];?></td></tr></tr>
									<?php
								}?></form>
                        </table>
                    </td></tr>
                <tr><td>Amount</td>
                    <td>
                        <table class="table table-bordered">
                            <tr><th>Gross Amount</th><th>18% GST</th><th>Res Fees</th><th>Total Payble Amount</th></tr>
							<?php 
							$class = strtolower($class) . '_fare';
							$q3 = "SELECT $class FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result3 = mysqli_query($db_conn,$q3);
							$count3 = mysqli_num_rows($result3);
							if($count3 > 0)
							{
								$rows3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
								$res_fees = 20;
								$res_fees = $res_fees * ($m + $f);
								$fare = $rows3[$class];
								$fare = $fare * ($m + $f);
								$GST = $fare * 18 /100;
								$total = round($fare + $GST);
							}
							?>
                            <tr><tr><td><?php echo $fare; ?></td><td><?php echo $GST; ?></td><td><?php echo $res_fees;?></td><td><?php echo $total; ?></td></tr></tr>
                        </table>
                    </td></tr>                
            </table>
			<button type="submit" class="btn btn-primary pull-right" form="ticketCancel">Cancel Ticket</button>
        </div> 
    </div>
</div>
<?php
		}
		else
		{
			echo '<div class="content">
	                <h4 class="text-center">No Data Found</h4></div>';
		}
		mysqli_close($db_conn);
		include_once 'footer.php';
	}
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/login_form.php");
	}	
?>