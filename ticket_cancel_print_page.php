<?php 
	session_start();
	$title = "Ticket Cancel Print Page";
    include_once 'header.php';
	include_once 'db_info.php';
	
	$pnr = $_REQUEST['pnr'];
	$trainno = $_REQUEST['trainno'];
	$source = $_REQUEST['source'];
	$destination= $_REQUEST['destination'];
	$class = strtoupper($_REQUEST['class']);
	$tct = $_REQUEST['total'];
	$date = $_REQUEST['date'];
	
	$m = 0;
	$f = 0;
	$c = 0;
	$total = 0;

	for($i=1; $i<=$tct; $i++)
	{	
		$pn = "pn$i";
		$pn = $_REQUEST[$pn];
		$pa = "pa$i";
		$pa = $_REQUEST[$pa];
		$ps = "ps$i";
		$ps = $_REQUEST[$ps];
		$pst = "pst$i";
		$pst = $_REQUEST[$pst];
		
		if($pa > 5 && $ps == MALE)
		{
			$m++;
			$total++;
		}
		if($pa > 5 && $ps == FEMALE)
		{
			$f++;
			$total++;
		}
		if($pa <= 5)
		{
			$c++;
			$total++;
		}
	}
?>
<div class="container content">
	<div class="row">
        <div class="well frm-center">
            <table class="table table-bordered">
                <h2 class="text-center">Ticket Cancellation Details</h2>
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
							for($i=1; $i<=$tct; $i++)
							{	
								$pn = "pn$i";
								$pn = $_REQUEST[$pn];
								$pa = "pa$i";
								$pa = $_REQUEST[$pa];
								$ps = "ps$i";
								$ps = $_REQUEST[$ps];
								$pst = "pst$i";
								$pst = $_REQUEST[$pst];
							?>
							<tr><tr><td><?php echo $pn;?></td><td><?php echo $pa;?></td><td><?php echo $ps;?></td><td><?php echo $pst;}?></td></tr></tr>
                        </table>
                    </td></tr>
                <tr><th>Amount</th>
                    <td>
                        <table class="table table-bordered">
                            <tr><th>Gross Amount</th><th>18% GST</th><th>Cancellation Charges</th><th>Total Refundable Amount</th></tr>
							<?php 
							$class = strtolower($class) . '_fare';
							$q4 = "SELECT $class FROM seatAvailability WHERE trainno = '$trainno' AND source = '$source' AND destination = '$destination'";
							$result4 = mysqli_query($db_conn,$q4);
							$count4 = mysqli_num_rows($result4);
							if($count4 > 0)
							{
								$row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
								$fare = $row4[$class];
								$can_charges = 120;
								$fare = $fare * ($m + $f);
								$GST = $fare * 18 /100;
								$total = $fare + $GST;
								$total = round($total);
								$can_charges = $can_charges * ($m + $f);
								$refund = $total - $can_charges;
								$refund = round($refund);
								?>
								<tr><tr><td><?php echo $fare; ?></td><td><?php echo $GST; ?></td><td><?php echo $can_charges;?></td><td><?php echo $refund; }?></td></tr></tr>
                        </table>
                    </td></tr>                
            </table>
			<button onClick="print_page()" id="print" class="btn btn-primary pull-right">Print Ticket</button>
        </div> 
    </div>
</div>
<script type="text/JavaScript" language="javascript" src="ORS.js"></script>
<?php
	include_once 'ticket_print_page.php';
	mysqli_close($db_conn);
    include_once 'footer.php';
?>