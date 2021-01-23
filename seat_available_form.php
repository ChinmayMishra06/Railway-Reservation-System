<?php
	session_start();
	if(isset($_SESSION['login']))
	{
    $title = "Ticket Availability Form";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
            <h2 class="text-center">Seat Availability</h2>
            <form action="seat_available_check.php" method="POST" role="form" name="seat_availability" onSubmit="return validateForm()">
                <div class="form-group">
                    <input type="text" class="form-control" name="trainno" placeholder="Train Number">
                </div>        
                <div class="form-group">
                    <input type="text" class="form-control" name="source" placeholder="Source Station">
                </div>        
                <div class="form-group">
                    <input type="text" class="form-control" name="destination" placeholder="Destination Station">
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" name="date" placeholder="Journey Date">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Availability</button>
            </form>
        </div> 
    </div>
</div>
<script type="text/javascript" language="JavaScript">
    function validateForm()
    {
        var trainno = document.seat_availability.trainno.value;
		var source = document.seat_availability.source.value;
		var destination = document.seat_availability.destination.value;		
		var date = document.seat_availability.date.value;
        
        if(trainno == "")
        {
            alert("Please enter train number");
            return false;
        }
		
		if(source == "")
        {
            alert("Please enter source station");
            return false;
        }
		
		if(destination == "")
        {
            alert("Please enter destination station");
            return false;
        }
		
		if(date == "")
        {
            alert("Please enter journey date");
            return false;
        }
    }
</script>    
<?php
    include_once 'footer.php';
	}
	else
	{
		header("refresh: 2, url='https://www.bccfalna.com/rm/OMS/");
	}	
?>