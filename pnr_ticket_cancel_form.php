<?php
	session_start();
	if(isset($_SESSION['login']))
	{
    $title = "PNR Ticket Cancel";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
			<h2 class="text-center">Ticket Cancel</h2>
            <form action="ticket_cancel_form.php" method="POST" role="form" name="tcf" onSubmit="return validateForm()">
				<div class="form-group">
                    <input type="text" class="form-control" name="pnr" placeholder="PNR Number">
                </div>                 
                <button type="submit" class="btn btn-primary pull-right">Cancel Ticket</button>
            </form>            
        </div> 
    </div>
</div>
<script type="text/javascript" language="JavaScript">
	function validateForm()
	{
		var pnr = document.tcf.pnr.value;
		
		if(pnr == "")
		{
			alert("Please enter pnr number");
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