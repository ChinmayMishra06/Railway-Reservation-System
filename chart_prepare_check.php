<?php
	session_start();
	
    $title = "Chart Prepare Check";
    include_once 'header.php';
	include_once 'db_info.php';
	$trainno = $_REQUEST['trainno'];
	$date = $_REQUEST['chart_prepare_date'];
	
	$q = "SELECT * FROM trainBooking WHERE date = '$date'";
	$result = mysqli_query($db_conn,$q);
	$count = mysqli_num_rows($result);
	if($count > 0)
	{
?>
<div class="container content">
		<div class="row">
            <div class="well frm-center">
            <table class="table table-bordered">
                <h2 class="text-center">Chart Details</h2>
				<p class="text-center"><b><span class="pull-left"><?php echo $trainno;	?></span><?php echo '<span class="pull-right">'. $date . '</span>';?></b></p>
                <tr><th>Coach</th><th>Name</th><th>Source</th><th>Destination</th><th>Age</th><th>Sex</th></tr>
				<?php
				for($i=1; $i<=$count; $i++)
				{
					$row = mysqli_fetch_array($result, MYSQLI_BOTH);
					$pnr = $row['pnr'];
					$trainno = strtoupper(trim($row['trainno']));
					$source = strtoupper(trim($row['source']));
					$destination = strtoupper(trim($row['destination']));
					$q1 = "SELECT * FROM passenger_information WHERE pnr = '$pnr'";
					$result1 = mysqli_query($db_conn, $q1);
					$count1 = mysqli_num_rows($result1);
					for($j=1; $j<=$count1; $j++)
					{					
						$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
						$passengerName= strtoupper(trim($row1['passenger_name']));
						$age = $row1['age'];
						$sex = $row1['sex'];
						$coach = $row1['status'];
						
				?>
				<tr><td><?php echo $coach;?></td><td><?php echo $passengerName;?></td><td><?php echo $source;?></td><td><?php echo $destination;?></td><td><?php echo $age;?></td><td><?php echo $sex;?></td></tr><?php } } ?>		
			</table>
			<button onClick="print_page()" id="print" class="btn btn-primary pull-right">Print Chart</button>
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
?>
<script type="text/JavaScript" language="javascript" src="ORS.js"></script>
<?php
	mysqli_close($db_conn);
    include_once 'footer.php';
?>