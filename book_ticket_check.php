<?php 
	session_start();
	$title = "Ticket Booking Check";
	include_once 'header.php';
	include_once 'db_info.php';
	$j = 7;
	
	$email = $_SESSION['login'];

	$pnr = rand(1000000,10000000);
	
	$trainno = trim($_REQUEST['trainno']);
	$source = strtoupper(trim($_REQUEST['source']));
	$destination = strtoupper(trim($_REQUEST['destination']));
	$date = trim($_REQUEST['date']);
	$class = strtolower(trim($_REQUEST['class']));
	$class1 = "$class" . "_seat";
	$class = strtoupper(trim($_REQUEST['class']));
	$total = $_REQUEST['total'];
	
	$q1 = "SELECT * FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
	$result1 = mysqli_query($db_conn, $q1);
	$count1 = mysqli_num_rows($result1);
	$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
	$waiting = abs($row1[$class1]);
	
	if($count1 > 0)
	{
		if($class1 == "sleeper_seat")
		{			
			$q2 = "INSERT INTO trainBooking (pnr, trainno, source, destination, class, date, email) VALUES ('$pnr', '$trainno', '$source', '$destination', '$class', '$date', '$email')";
			$result2 = mysqli_query($db_conn, $q2);
			if($result2)
			{
				for($i=1; $i<=$total; $i++)
				{
					$pa = "pa"."$i";
					$pa = strtoupper($_REQUEST[$pa]);
					if($pa > 5)
					{
						$q3 = "SELECT $class1, seat_book, coach FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
						$result3 = mysqli_query($db_conn, $q3);
						$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
						
						$sleeper_seat = $row3['sleeper_seat'];
						$seat_book = $row3['seat_book'];
						$coach = $row3['coach'];
						
						if($sleeper_seat > 0)
						{
							if($seat_book > 71)
							{
								$coach++;
								$seat_book = 0;
								
								$q4 = "UPDATE seatAvailability SET seat_book = '$seat_book', coach = '$coach' WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
								$result4 = mysqli_query($db_conn, $q4);
								if($result4)
								{
									$status = "S$coach";
									$status = "$status, " . ++$seat_book;
								}
								else
								{
									mysqli_error($db_conn);
								}
							}
							else
							{
								$status = "S$coach";
								$status = "$status, " . ++$seat_book;
							}
						}
						else
						{
							$status = "W/L " . ++$waiting;					
						}
					
						$pn = "pn"."$i";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$i";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$i";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						
						
						$q5 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', '$status')";
						$result5 = mysqli_query($db_conn, $q5);
						
						if($result5)
						{
							
							$q6 = "UPDATE seatAvailability SET $class1 = ($class1 - 1), seat_book = '$seat_book' WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
							$result6 = mysqli_query($db_conn, $q6);
							if($result6)
							{
								header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
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
					else
					{
						$pn = "pn"."$j";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$j";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$j";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						$j++;
						$q5 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', 'NULL')";
						$result5 = mysqli_query($db_conn, $q5);						
						
						if($result5)
						{
							header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
						}
						
						else
						{
							mysqli_error($db_conn);
						}
					}
				}
			}
		}
		
		if($class1 == "ac1_seat")
		{			
			$q2 = "INSERT INTO trainBooking (pnr, trainno, source, destination, class, date, email) VALUES ('$pnr', '$trainno', '$source', '$destination', '$class', '$date', '$email')";
			$result2 = mysqli_query($db_conn, $q2);
			if($result2)
			{
				for($i=1; $i<=$total; $i++)
				{
					$pa = "pa"."$i";
					$pa = $_REQUEST[$pa];
					if($pa > 5)
					{
						$q3 = "SELECT $class1, ac1_book FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
						$result3 = mysqli_query($db_conn, $q3);
						$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
						
						$ac1_seat = $row3['ac1_seat'];
						$ac1_book = $row3['ac1_book'];
							
						if($ac1_seat > 0)
						{	
							$status = "AC1";
							$status = "$status, " . ++$ac1_book;
						}
						else
						{
							$status = "W/L " . ++$waiting;					
						}
					
						$pn = "pn"."$i";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$i";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$i";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						
						$q4 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', '$status')";
						$result4 = mysqli_query($db_conn, $q4);						
						
						if($result4)
						{
							$q5 = "UPDATE seatAvailability SET $class1 = ($class1 - 1), ac1_book = '$ac1_book' WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
							$result5 = mysqli_query($db_conn, $q5);
							if($result5)
							{
								header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
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
					else
					{
						$pn = "pn"."$j";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$j";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$j";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						$j++;
						$class = strtoupper($class);
						
						$q4 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', 'NULL')";
						$result4 = mysqli_query($db_conn, $q4);						
						
						if($result4)
						{
							header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
						}
						
						else
						{
							mysqli_error($db_conn);
						}
					}
				}
			}			
		}
		
		if($class1 == "ac2_seat")
		{			
			$q2 = "INSERT INTO trainBooking (pnr, trainno, source, destination, class, date, email) VALUES ('$pnr', '$trainno', '$source', '$destination', '$class', '$date', '$email')";
			$result2 = mysqli_query($db_conn, $q2);
			if($result2)
			{
				for($i=1; $i<=$total; $i++)
				{
					$pa = "pa"."$i";
					$pa = $_REQUEST[$pa];
					if($pa > 5)
					{
						$q3 = "SELECT $class1, ac2_book FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
						$result3 = mysqli_query($db_conn, $q3);
						$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
						
						$ac2_seat = $row3['ac2_seat'];
						$ac2_book = $row3['ac2_book'];
							
						if($ac2_seat > 0)
						{	
							$status = "AC2";
							$status = "$status, " . ++$ac2_book;
						}
						else
						{
							$status = "W/L " . ++$waiting;					
						}
					
						$pn = "pn"."$i";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$i";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$i";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						
						$q4 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', '$status')";
						$result4 = mysqli_query($db_conn, $q4);
						if($result4)
						{
							$q5 = "UPDATE seatAvailability SET $class1 = ($class1 - 1), ac2_book = '$ac2_book' WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
							$result5 = mysqli_query($db_conn, $q5);
							if($result5)
							{
								header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
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
					else
					{
						$pn = "pn"."$j";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$j";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$j";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						$j++;
						$class = strtoupper($class);
						
						$q4 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', 'NULL')";
						$result4 = mysqli_query($db_conn, $q4);						
						
						if($result4)
						{
							header("refresh:2; url=https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
						}
						
						else
						{
							mysqli_error($db_conn);
						}
					}
				}
			}			
		}
		
		if($class1 == "ac3_seat")
		{			
			$q2 = "INSERT INTO trainBooking (pnr, trainno, source, destination, class, date, email) VALUES ('$pnr', '$trainno', '$source', '$destination', '$class', '$date', '$email')";
			$result2 = mysqli_query($db_conn, $q2);
			if($result2)
			{
				for($i=1; $i<=$total; $i++)
				{
					$pa = "pa"."$i";
					$pa = $_REQUEST[$pa];
					if($pa > 5)
					{
						$q3 = "SELECT $class1, ac3_book FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
						$result3 = mysqli_query($db_conn, $q3);
						$row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
						
						$ac3_seat = $row3['ac3_seat'];
						$ac3_book = $row3['ac3_book'];
							
						if($ac3_seat > 0)
						{	
							$status = "AC3";
							$status = "$status, " . ++$ac3_book;
						}
						else
						{
							$status = "W/L " . ++$waiting;					
						}
					
						$pn = "pn"."$i";
						$pn = strtoupper($_REQUEST[$pn]);
						
						$pa = "pa"."$i";
						$pa = strtoupper($_REQUEST[$pa]);
						
						$ps = "ps"."$i";
						$ps = strtoupper($_REQUEST[$ps]);
						$class = strtoupper($class);
						
						$q4 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', '$status')";
						$result4 = mysqli_query($db_conn, $q4);
						if($result4)
						{
							$q5 = "UPDATE seatAvailability SET $class1 = ($class1 - 1), ac3_book = '$ac3_book' WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination' AND date = '$date'";
							$result5 = mysqli_query($db_conn, $q5);
							if($result5)
							{
								header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
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
    				else
    				{
    					$pn = "pn"."$j";
    					$pn = strtoupper($_REQUEST[$pn]);
    					
    					$pa = "pa"."$j";
    					$pa = strtoupper($_REQUEST[$pa]);
    					
    					$ps = "ps"."$j";
    					$ps = strtoupper($_REQUEST[$ps]);
    					$class = strtoupper($class);
    					$j++;
    					$class = strtoupper($class);
    					
    					$q4 = "INSERT INTO passenger_information (pnr, passenger_name, age, sex, status) VALUES ('$pnr', '$pn', '$pa', '$ps', 'NULL')";
    					$result4 = mysqli_query($db_conn, $q4);						
    					
    					if($result4)
    					{
    						header("Location: https://www.bccfalna.com/rm/OMS/ticket_print_page.php?pnr=$pnr");
    					}
    					
    					else
    					{
    						mysqli_error($db_conn);
    					}
    				}
				}					
			}			
		}
	}
	else
	{
	    echo '<div class="content"></div>';
	}
	mysqli_close($db_conn);
	include_once 'footer.php';
?>