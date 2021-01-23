<?php
	session_start();
    $title = "Ticket Cancel Check";
    include_once 'header.php';
	include_once 'db_info.php';
	
	$class = strtolower(trim($_REQUEST['class']));
	$class1 = $class . "_seat";
	$pnr = strtolower(trim($_REQUEST['pnr']));	
	$trainno = trim($_REQUEST['trainno']);
	$source = $_REQUEST['source'];
	$destination = $_REQUEST['destination'];
	$date = $_REQUEST['date'];
	$total = $_REQUEST['total'];
	$cancel_ticket = 0;
	
	if($class == 'sleeper')
	{
		$class2 = "seat_book";?>
		<form action="ticket_cancel_print_page.php" method="POST" id="tcpp">
			<input type="hidden" name="pnr"  value="<?php echo $pnr; ?>"/>
			<input type="hidden" name="trainno"  value="<?php echo $trainno; ?>"/>
			<input type="hidden" name="source"  value="<?php echo $source; ?>"/>
			<input type="hidden" name="destination"  value="<?php echo $destination; ?>"/>
			<input type="hidden" name="date"  value="<?php echo $date; ?>"/>
			<input type="hidden" name="class"  value="<?php echo $class; ?>"/><?php
		for($i=1; $i<=$total; $i++)
		{
			$cancel = "cancel$i";
			if(isset($_REQUEST[$cancel]))
			{
				$passengerName = $_REQUEST[$cancel];					
				$q1 = "SELECT * FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result1 = mysqli_query($db_conn,$q1);
				$count1 = mysqli_num_rows($result1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
				$pn = $row1['passenger_name'];
				$pa = $row1['age'];
				$ps = $row1['sex'];
				$status = $row1['status'];
				
				$q2 = "DELETE FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result2 = mysqli_query($db_conn,$q2);
				if($result2)
				{
					if($count1 > 0)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/>
						</form>
						<?php
						if($pa > 5)
						{
							$q3 = "UPDATE seatAvailability SET $class1 = ($class1 + 1), $class2 = ($class2 - 1) WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result3 = mysqli_query($db_conn,$q3);
						}
					}
				}
			}
		}
		
		$q4 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
		$result4 = mysqli_query($db_conn,$q4);
		$count4 = mysqli_num_rows($result4);
		if($count4 == 1)
		{
			$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
			$pn = $row4['passenger_name'];
			$pa = $row4['age'];
			$ps = $row4['sex'];
			$status = $row4['status'];
			if($pa <= 5)
			{
				$q5 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
				$result5 = mysqli_query($db_conn,$q5);
				if($result5)
				{
					$q6 = "DELETE FROM passenger_information WHERE pnr = '$pnr'";
					$result6 = mysqli_query($db_conn,$q6);
					if($result6)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/><?php
					}
					else
					{
						mysqli_error($db_conn);
					}
				}
				else
				{
					mysqli_error($db_conn);
				}
			}
		}
		if($count4 == 0)
		{
			$q6 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
			$result6 = mysqli_query($db_conn,$q6);			
		}
		?><input type="hidden" form="tcpp" name="total"  value="<?php echo $cancel_ticket; ?>"/><?php
	}
	if($class == 'ac1')
	{
		$class2 = "ac1_book";?>
		<form action="ticket_cancel_print_page.php" method="POST" id="tcpp">
			<input type="hidden" name="pnr"  value="<?php echo $pnr; ?>"/>
			<input type="hidden" name="trainno"  value="<?php echo $trainno; ?>"/>
			<input type="hidden" name="source"  value="<?php echo $source; ?>"/>
			<input type="hidden" name="destination"  value="<?php echo $destination; ?>"/>
			<input type="hidden" name="date"  value="<?php echo $date; ?>"/>
			<input type="hidden" name="class"  value="<?php echo $class; ?>"/><?php
		for($i=1; $i<=$total; $i++)
		{
			$cancel = "cancel$i";
			if(isset($_REQUEST[$cancel]))
			{
				$passengerName = $_REQUEST[$cancel];					
				$q1 = "SELECT * FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result1 = mysqli_query($db_conn,$q1);
				$count1 = mysqli_num_rows($result1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
				$pn = $row1['passenger_name'];
				$pa = $row1['age'];
				$ps = $row1['sex'];
				$status = $row1['status'];
				
				$q2 = "DELETE FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result2 = mysqli_query($db_conn,$q2);
				if($result2)
				{
					if($count1 > 0)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/>
						</form>
						<?php
						if($pa > 5)
						{
							$q3 = "UPDATE seatAvailability SET $class1 = ($class1 + 1), $class2 = ($class2 - 1) WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result3 = mysqli_query($db_conn,$q3);
						}
					}
				}
			}
		}
		
		$q4 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
		$result4 = mysqli_query($db_conn,$q4);
		$count4 = mysqli_num_rows($result4);
		if($count4 == 1)
		{
			$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
			$pn = $row4['passenger_name'];
			$pa = $row4['age'];
			$ps = $row4['sex'];
			$status = $row4['status'];
			if($pa <= 5)
			{
				$q5 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
				$result5 = mysqli_query($db_conn,$q5);
				if($result5)
				{
					$q6 = "DELETE FROM passenger_information WHERE pnr = '$pnr'";
					$result6 = mysqli_query($db_conn,$q6);
					if($result6)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/><?php
					}
					else
					{
						mysqli_error($db_conn);
					}
				}
				else
				{
					mysqli_error($db_conn);
				}
			}
		}
		if($count4 == 0)
		{
			$q6 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
			$result6 = mysqli_query($db_conn,$q6);			
		}
		?><input type="hidden" form="tcpp" name="total"  value="<?php echo $cancel_ticket; ?>"/><?php
	}
	
	if($class == 'ac2')
	{
		$class2 = "ac2_book";
		$class2 = "ac1_book";?>
		<form action="ticket_cancel_print_page.php" method="POST" id="tcpp">
			<input type="hidden" name="pnr"  value="<?php echo $pnr; ?>"/>
			<input type="hidden" name="trainno"  value="<?php echo $trainno; ?>"/>
			<input type="hidden" name="source"  value="<?php echo $source; ?>"/>
			<input type="hidden" name="destination"  value="<?php echo $destination; ?>"/>
			<input type="hidden" name="date"  value="<?php echo $date; ?>"/>
			<input type="hidden" name="class"  value="<?php echo $class; ?>"/><?php
		for($i=1; $i<=$total; $i++)
		{
			$cancel = "cancel$i";
			if(isset($_REQUEST[$cancel]))
			{
				$passengerName = $_REQUEST[$cancel];					
				$q1 = "SELECT * FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result1 = mysqli_query($db_conn,$q1);
				$count1 = mysqli_num_rows($result1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
				$pn = $row1['passenger_name'];
				$pa = $row1['age'];
				$ps = $row1['sex'];
				$status = $row1['status'];
				
				$q2 = "DELETE FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result2 = mysqli_query($db_conn,$q2);
				if($result2)
				{
					if($count1 > 0)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/>
						</form>
						<?php
						if($pa > 5)
						{
							$q3 = "UPDATE seatAvailability SET $class1 = ($class1 + 1), $class2 = ($class2 - 1) WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result3 = mysqli_query($db_conn,$q3);
						}
					}
				}
			}
		}
		
		$q4 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
		$result4 = mysqli_query($db_conn,$q4);
		$count4 = mysqli_num_rows($result4);
		if($count4 == 1)
		{
			$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
			$pn = $row4['passenger_name'];
			$pa = $row4['age'];
			$ps = $row4['sex'];
			$status = $row4['status'];
			if($pa <= 5)
			{
				$q5 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
				$result5 = mysqli_query($db_conn,$q5);
				if($result5)
				{
					$q6 = "DELETE FROM passenger_information WHERE pnr = '$pnr'";
					$result6 = mysqli_query($db_conn,$q6);
					if($result6)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/><?php
					}
					else
					{
						mysqli_error($db_conn);
					}
				}
				else
				{
					mysqli_error($db_conn);
				}
			}
		}
		if($count4 == 0)
		{
			$q6 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
			$result6 = mysqli_query($db_conn,$q6);			
		}
		?><input type="hidden" form="tcpp" name="total"  value="<?php echo $cancel_ticket; ?>"/><?php
	}
	
	if($class == 'ac3')
	{
		$class2 = "ac3_book";
		$class2 = "ac1_book";?>
		<form action="ticket_cancel_print_page.php" method="POST" id="tcpp">
			<input type="hidden" name="pnr"  value="<?php echo $pnr; ?>"/>
			<input type="hidden" name="trainno"  value="<?php echo $trainno; ?>"/>
			<input type="hidden" name="source"  value="<?php echo $source; ?>"/>
			<input type="hidden" name="destination"  value="<?php echo $destination; ?>"/>
			<input type="hidden" name="date"  value="<?php echo $date; ?>"/>
			<input type="hidden" name="class"  value="<?php echo $class; ?>"/><?php
		for($i=1; $i<=$total; $i++)
		{
			$cancel = "cancel$i";
			if(isset($_REQUEST[$cancel]))
			{
				$passengerName = $_REQUEST[$cancel];					
				$q1 = "SELECT * FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result1 = mysqli_query($db_conn,$q1);
				$count1 = mysqli_num_rows($result1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
				$pn = $row1['passenger_name'];
				$pa = $row1['age'];
				$ps = $row1['sex'];
				$status = $row1['status'];
				
				$q2 = "DELETE FROM passenger_information WHERE pnr = '$pnr' AND passenger_name = '$passengerName'";
				$result2 = mysqli_query($db_conn,$q2);
				if($result2)
				{
					if($count1 > 0)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/>
						</form>
						<?php
						if($pa > 5)
						{
							$q3 = "UPDATE seatAvailability SET $class1 = ($class1 + 1), $class2 = ($class2 - 1) WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result3 = mysqli_query($db_conn,$q3);
						}
					}
				}
			}
		}
		
		$q4 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
		$result4 = mysqli_query($db_conn,$q4);
		$count4 = mysqli_num_rows($result4);
		if($count4 == 1)
		{
			$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
			$pn = $row4['passenger_name'];
			$pa = $row4['age'];
			$ps = $row4['sex'];
			$status = $row4['status'];
			if($pa <= 5)
			{
				$q5 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
				$result5 = mysqli_query($db_conn,$q5);
				if($result5)
				{
					$q6 = "DELETE FROM passenger_information WHERE pnr = '$pnr'";
					$result6 = mysqli_query($db_conn,$q6);
					if($result6)
					{
						$cancel_ticket++;
						$pname = "pn$cancel_ticket";
						$page = "pa$cancel_ticket";
						$psex = "ps$cancel_ticket";
						$pstatus = "pst$cancel_ticket";
						?>						
						<input type="hidden" form="tcpp" name="<?php echo $pname; ?>"  value="<?php echo $pn; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $page; ?>"  value="<?php echo $pa; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $psex; ?>"  value="<?php echo $ps; ?>"/>
						<input type="hidden" form="tcpp" name="<?php  echo $pstatus; ?>"  value="<?php echo $status; ?>"/><?php
					}
					else
					{
						mysqli_error($db_conn);
					}
				}
				else
				{
					mysqli_error($db_conn);
				}
			}
		}
		if($count4 == 0)
		{
			$q6 = "DELETE FROM trainBooking WHERE pnr = '$pnr'";
			$result6 = mysqli_query($db_conn,$q6);			
		}
		?><input type="hidden" form="tcpp" name="total"  value="<?php echo $cancel_ticket; ?>"/><?php
	}
	mysqli_close($db_conn);
?>
<script type="text/JavaScript" language="JavaScript">
document.getElementById('tcpp').submit();
</script>
<?php
    include_once 'footer.php';	
?>