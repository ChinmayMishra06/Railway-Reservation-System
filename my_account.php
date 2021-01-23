<?php 
	session_start();
	if(isset($_SESSION['login']))
	{
	$title = "My Account";
    include_once 'header.php';
	include_once 'db_info.php';
	$email = $_SESSION['login'];
	
	$q1 = "SELECT * FROM trainBooking WHERE email = '$email'";
	$result1 = mysqli_query($db_conn, $q1);
	$count1 = mysqli_num_rows($result1);
	
	if($count1 > 0)
	{
		for($i=1; $i<=$count1; $i++)
		{
			$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
			$pnr = $row1['pnr'];
			
			$q2 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
			$result2 = mysqli_query($db_conn, $q2);
			$count2 = mysqli_num_rows($result2);
			if($count2 > 0)
			{
				$row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
				$trainno = $row1['trainno'];
				$source = $row1['source'];
				$destination = $row1['destination'];
				$class = $row1['class'];
				$date = $row1['date'];
				if($class == "SLEEPER")
				{	
					$m = 0;
					$f = 0;
					$c = 0;
					$total = 0;
	
					$q3 = "SELECT age, sex FROM passenger_information WHERE pnr = '$pnr'";
					$result3 = mysqli_query($db_conn, $q3);
					$count3 = mysqli_num_rows($result3);
					if($count3 > 0)
					{
						for($j=1; $j<=$count3; $j++)
						{
							$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
							$age = $row3['age'];
							$sex = $row3['sex'];
							
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
				}
				if($class == "AC1")
				{	
					$m = 0;
					$f = 0;
					$c = 0;
					$total = 0;
	
					$q3 = "SELECT age, sex FROM passenger_information WHERE pnr = '$pnr'";
					$result3 = mysqli_query($db_conn, $q3);
					$count3 = mysqli_num_rows($result3);
					if($count3 > 0)
					{
						for($j=1; $j<=$count3; $j++)
						{
							$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
							$age = $row3['age'];
							$sex = $row3['sex'];
							
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
				}
				if($class == "AC2")
				{	
					$m = 0;
					$f = 0;
					$c = 0;
					$total = 0;
	
					$q3 = "SELECT age, sex FROM passenger_information WHERE pnr = '$pnr'";
					$result3 = mysqli_query($db_conn, $q3);
					$count3 = mysqli_num_rows($result3);
					if($count3 > 0)
					{
						for($j=1; $j<=$count3; $j++)
						{
							$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
							$age = $row3['age'];
							$sex = $row3['sex'];
							
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
				}
				if($class == "AC3")
				{	
					$m = 0;
					$f = 0;
					$c = 0;
					$total = 0;
	
					$q3 = "SELECT age, sex FROM passenger_information WHERE pnr = '$pnr'";
					$result3 = mysqli_query($db_conn, $q3);
					$count3 = mysqli_num_rows($result3);
					if($count3 > 0)
					{
						for($j=1; $j<=$count3; $j++)
						{
							$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
							$age = $row3['age'];
							$sex = $row3['sex'];
							
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
				}
			}
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
				<tr><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
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
								$result4 = mysqli_query($db_conn,$q2);
								$count4 = mysqli_num_rows($result4);
								for($k=1; $k<=$count3; $k++)
								{
									$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
									?>
										<tr><tr><td><?php echo $row4['passenger_name'];?></td><td><?php echo $row4['age'];?></td><td><?php echo $row4['sex'];?></td><td><?php echo strtoupper($row4['status']);?></td></tr></tr>
									<?php
								}?>
                        </table>
                    </td></tr>
                <tr><th>Amount</th>
                    <td>
                        <table class="table table-bordered">
                            <tr><th>Gross Amount</th><th>18% GST</th><th>Res Fees</th><th>Total Payble Amount</th></tr>
							<?php 
							$class = strtolower($class) . '_fare';
							$q5 = "SELECT $class FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result5 = mysqli_query($db_conn,$q5);
							$count5 = mysqli_num_rows($result5);
							if($count5 > 0)
							{
								$row5 = mysqli_fetch_array($result5, MYSQLI_BOTH);
								$res_fees = 20;
								$res_fees = $res_fees * ($m + $f);
								$fare = $row5[$class];
								$fare = $fare * ($m + $f);
								$GST = $fare * 18 /100;
								$total = round($fare + $GST);
								
							}
							?>							
                            <tr><tr><td><?php echo $fare; ?></td><td><?php echo $GST; ?></td><td><?php echo $res_fees;?></td><td><?php echo $total; ?></td></tr></tr>
                        </table>
                    </td></tr>                
            </table>
			<button onClick="print_page()" id="print" class="btn btn-primary pull-right">Print Ticket</button>
        </div> 
    </div>
</div>
<?php
		}
	}
	else
	{
	    echo '<div class="content">
	                <h4 class="text-center">No Data Found.</h4></div>';
	}
?>
<script type="text/JavaScript" language="javascript" src="ORS.js"></script>
<?php
    include_once 'footer.php';
	}
	
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/");
	}		
	mysqli_close($db_conn);
?>