<?php 
	session_start();
	$title = "Insert Date";
    include_once 'header.php';
	
    if(isset($_REQUEST['btn_date']))
    {
        include_once 'db_info.php';
        $date = $_REQUEST['insert_date'];
        $q1 = "UPDATE seatAvailability SET date = '$date'";
        $result1 = mysqli_query($db_conn, $q1);
        
        if($result1)
        {
            echo '<div class="content"><h4 class="text-center">Date Updated.</h4></div>';
        }
        
    }
	else
	{?>
	    <div class="container content">
	        <div class="row centering">
	            <div class="well">
	                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            	        <div class="form-group">
            	            <h2 class="text-center">Update Date</h2>
            	            <input type="date" name="insert_date" class="form-control"/>
            	        </div>
            	        <button type="submit" class="btn btn-primary pull-right" name="btn_date">Update date</button>
            	    </form>      
	            </div>
	        </div>
	    </div>
	<?php } ?>
<script type="text/JavaScript" language="javascript" src="ORS.js"></script>
<?php
	mysqli_close($db_conn);
    include_once 'footer.php';
?>