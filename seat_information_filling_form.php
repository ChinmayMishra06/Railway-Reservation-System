<?php
	session_start();
	if(isset($_SESSION['login']) && isset($_SESSION['admin']))
	{
    $title = "Seat Information Filling Form";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
            <h2 class="text-center">Seat Avilability Details</h2>
            <form action="seat_information_filling_check.php" method="POST" role="form" name="book_ticket_form" onSubmit="return validateForm()">
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
                    <input type="date" class="form-control" name="date" placeholder="Journey Date"/>
                </div>
				<div class="form-group">
                    <input type="number" class="form-control" name="sleeper_fare" placeholder="Sleeper Fare"/>
                </div>
				<div class="form-group">
                    <input type="number" class="form-control" name="ac1_fare" placeholder="AC1 Fare"/>
                </div>
				<div class="form-group">
                    <input type="number" class="form-control" name="ac2_fare" placeholder="AC2 Fare"/>
                </div>
				<div class="form-group">
                    <input type="number" class="form-control" name="ac3_fare" placeholder="AC3 Fare"/>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Fill Details</button>
            </form>
        </div> 
    </div>
</div>
<script type="text/javascript" language="JavaScript">
    function validateForm()
    {
        var trainno = document.book_ticket_form.trainno.value;
		var source = document.book_ticket_form.source.value;
		var destination = document.book_ticket_form.destination.value;		
		var sleeper_fare = document.book_ticket_form.sleeper_fare.value;
		var ac1_fare = document.book_ticket_form.ac1_fare.value;
		var ac2_fare = document.book_ticket_form.ac2_fare.value;
		var ac3_fare = document.book_ticket_form.ac3_fare.value;
		var date = document.book_ticket_form.date.value;
        
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
		if(sleeper_fare == "")
        {
            alert("Please enter fill sleeper fare");
            return false;
        }
		
		if(ac1_fare == "")
        {
            alert("Please enter fill first ac fare");
            return false;
        }
		
		if(ac2_fare == "")
        {
            alert("Please enter fill second ac fare");
            return false;
        }
		
		if(ac3_fare == "")
        {
            alert("Please enter fill third ac field");
            return false;
        }
		
    }
</script>    
<?php
    include_once 'footer.php';
	}
	else
	{
		header("Location:https://www.bccfalna.com/rm/OMS/");
	}	
?>