<?php
	session_start();
    $title = "PNR Form";
    include_once 'header.php';
?>
<div class="container content">
	<div class="row centering">
        <div class="well">
			<h2 class="text-center">PNR Status</h2>
            <form action="ticket_print_page.php" method="POST" role="form" name="pnr_status_form" onSubmit="return validateForm()">
				<div class="form-group">
                    <input type="text" class="form-control" name="pnr" placeholder="PNR Number">
                </div>                 
                <button type="submit" class="btn btn-primary pull-right">Check Status</button>
            </form>            
        </div> 
    </div>
</div>
<script type="text/javascript" language="JavaScript">
	function validateForm()
	{
		var pnr = document.pnr_status_form.pnr.value;
		
		if(pnr == "")
		{
			alert("Please enter pnr number");
			return false;
		}
	}

</script>
<?php
    include_once 'footer.php';
?>