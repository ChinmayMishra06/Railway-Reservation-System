<?php
	session_start();
	if(isset($_SESSION['login']))
	{
		$title = "Ticket Booking";
		include_once 'header.php';
		$total = 0;
	?>
	<div class="container content">
		<div class="row">
            <div class="well frm-center" style="max-width: 500px;">
				<h2 class="text-center">Ticket Booking</h2>
				<form action="book_ticket_check.php" method="POST" role="form" class="form-horizontal" name="book_ticket_form" id="book_ticket_form" onSubmit="return validateForm()">
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
						<select name="class">
							<option value="">Select</option>
							<option>Sleeper</option>
							<option>AC1</option>
							<option>AC2</option>
							<option>AC3</option>
						</select>
					</div>
					<div class="form-group">
						<input type="date" class="form-control" name="date" placeholder="Enter Your Journey Date">
					</div>
					<?php for($i=1; $i<=6; $i++){$pn = "pn$i";$pa = "pa$i";$ps = "ps$i";?>                   
					<div id="frm" class="form-group">
						<input type="text" name="<?php echo $pn;?>" placeholder="<?php echo $i . " " ;?>Passenger Name">
						<input type="text" name="<?php echo $pa;?>" placeholder="Age"/>
							<select name="<?php echo $ps;?>">
								<option value="">Sex</option>
								<option>Male</option>
								<option>Female</option>
							</select>
					</div><?php }?>
					<h2 class="text-center">Child Below 5 Years</h2>
					<?php 
					$c = 0;
					for($i=7; $i<=8; $i++){$pn = "pn$i";$pa = "pa$i";$ps = "ps$i";?>                   
					<div id="frm" class="form-group">
						<input type="text" name="<?php echo $pn;?>" placeholder="<?php echo ++$c . " " ;?>Child Name">
						<input type="text" name="<?php echo $pa;?>" placeholder="Age"/>
							<select name="<?php echo $ps;?>">
								<option value="">Sex</option>
								<option>Male</option>
								<option>Female</option>
							</select>
					</div><?php }?>
					<input type="hidden" name="total" id="total"/>
					<button type="submit" class="btn btn-primary pull-right">Booking</button>
				</form>            
			</div> 
		</div>
	</div>
	
<script type="text/javascript" language="JavaScript">
	function validateForm()
    {
		var total = 0;
		var trainno = document.book_ticket_form.trainno.value;
		var source = document.book_ticket_form.source.value;
		var destination = document.book_ticket_form.destination.value;		
		var coach = document.book_ticket_form.class.value;
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
		
		if(coach == "")
        {
            alert("Please enter class");
            return false;
        }
		
		if(date == "")
        {
            alert("Please enter journey date");
            return false;
        }
		
		var pn1 = document.book_ticket_form.pn1.value;
		var pa1 = document.book_ticket_form.pa1.value;
		var ps1 = document.book_ticket_form.ps1.value;

		if(pn1 != "")
		{			
			if(pa1 != "")
			{			
				if(pa1 > 5)
				{
					if(ps1 == "")
					{				
						alert("Please enter sex for " + pn1);
						return false;
					}
					total++;
				}
				else
				{
					alert("Passenger age should be greater than 5 years for " + pn1);
					return false;
				}
			}
			else
			{
				alert("Please enter age for " + pn1);
				return false;
			}
			
		}
		
		var pn2 = document.book_ticket_form.pn2.value;
		var pa2 = document.book_ticket_form.pa2.value;
		var ps2 = document.book_ticket_form.ps2.value;

		if(pn2 != "")
		{		
			if(pa2 != "")
			{		
				if(pa2 > 5)
				{
					if(ps2 == "")
					{				
						alert("Please enter sex for " + pn2);
						return false;
					}
					total++;
				}
				else
				{
					alert("Passenger age should be greater than 5 years for " + pn2);
					return false;
				}
			}
			else
			{
				alert("Please enter age for " + pn2);
				return false;
			}
			
		}
		
		var pn3 = document.book_ticket_form.pn3.value;
		var pa3 = document.book_ticket_form.pa3.value;
		var ps3 = document.book_ticket_form.ps3.value;

		if(pn3 != "")
		{	
			if(pa3 != "")
			{				
				if(pa3 > 5)
				{
					if(ps1 == "")
					{				
						alert("Please enter sex for " + pn3);
						return false;
					}
					total++;;
				}
				else
				{
					alert("Passenger age should be greater than 5 years for " + pn3);
					return false;
				}
			}
			else
			{
				alert("Please enter age for " + pn3);
				return false;
			}
			
		}
		
		var pn4 = document.book_ticket_form.pn4.value;
		var pa4 = document.book_ticket_form.pa4.value;
		var ps4 = document.book_ticket_form.ps4.value;

		if(pn4 != "")
		{	
			if(pa4 != "")
			{				
				if(pa4 > 5)
				{
					if(ps4 == "")
					{				
						alert("Please enter sex for " + pn4);
						return false;
					}
					total++;;
				}
				else
				{
					alert("Passenger age should be greater than 5 years for " + pn4);
					return false;
				}
			}
			else
			{
				alert("Please enter age for " + pn4);
				return false;
			}
			
		}
		
		var pn5 = document.book_ticket_form.pn5.value;
		var pa5 = document.book_ticket_form.pa5.value;
		var ps5 = document.book_ticket_form.ps5.value;

		if(pn5 != "")
		{	
			if(pa5 != "")
			{				
				if(pa5 > 5)
				{
					if(ps5 == "")
					{				
						alert("Please enter sex for " + pn5);
						return false;
					}
					total++;;
				}
				else
				{
					alert("Passenger age should be greater than 5 years for " + pn5);
					return false;
				}
			}
			else
			{
				alert("Please enter age for " + pn5);
				return false;
			}
			
		}
		
		var pn6 = document.book_ticket_form.pn6.value;
		var pa6 = document.book_ticket_form.pa6.value;
		var ps6 = document.book_ticket_form.ps6.value;

		if(pn6 != "")
		{	
			if(pa6 != "")
			{				
				if(pa6 > 5)
				{
					if(ps6 == "")
					{				
						alert("Please enter sex for " + pn6);
						return false;
					}
					total++;;
				}
				else
				{
					alert("Passenger age should be greater than 5 years for " + pn6);
					return false;
				}
			}
			else
			{
				alert("Please enter age for " + pn6);
				return false;
			}
			
		}
		
		var pn7 = document.book_ticket_form.pn7.value;
		var pa7 = document.book_ticket_form.pa7.value;
		var ps7 = document.book_ticket_form.ps7.value;

		if(pn7 != "")
		{	
			if(pa7 != "")
			{	if(pa7 <= 5)
				{
					if(ps7 == "")
					{				
						alert("Please enter sex for " + pn7);
						return false;
					}
					total++;;
				}
				else
				{
					alert("Child age should be less than or equal to 5 years for " +pn7);
					return false;
				}		
				
			}
			else
			{
				alert("Please enter age for " + pn7);
				return false;
			}
			
		}
		
		var pn8 = document.book_ticket_form.pn8.value;
		var pa8 = document.book_ticket_form.pa8.value;
		var ps8 = document.book_ticket_form.ps8.value;

		if(pn8 != "")
		{	
			if(pa8 <= 5)
			{
				if(ps7 == "")
				{				
					alert("Please enter sex for " + pn8);
					return false;
				}
				total++;;
			}
			else
			{
				alert("Child age should be less than or equal to 5 years for " +pn8);
				return false;
			}	
			
		}
		document.getElementById("total").value=total;
	}
</script>
<?php
		include_once 'footer.php';
	}
	else
	{
		header("Location: http://www.bccfalna.com/rm/OMS/login_form.php");
	}
?>