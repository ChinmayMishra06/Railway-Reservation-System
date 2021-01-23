<?php
	session_start();
	if(isset($_SESSION['login']) && isset($_SESSION['admin']))
	{
    $title = "Chart Prepare Form";
    include_once 'header.php';
?>
<div class="container content">
		<div class="row centering">
            <div class="well">
			<h2 class="text-center">Chart Prepare</h2>
			<form action="chart_prepare_check.php" method="POST" name="chart_prepare_form" onSubmit="return validateForm()">
				<div class="form-group">
					<input type="text" class="form-control" name="trainno" placeholder="Train Number"/>
				</div>
				<div class="form-group">
					<input type="date" class="form-control" name="chart_prepare_date"/>
				</div>
				<button type="submit" class="btn btn-primary pull-right">Chart Prepare</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" language="JavaScript">
	function validateForm()
	{
		var trainno = document.chart_prepare_form.trainno.value;
		var chart_prepare_date = document.chart_prepare_form.chart_prepare_date.value;
		
		if(trainno == "")
		{
			alert("Please enter trainno number");
			return false;
		}
		if(chart_prepare_date == "")
		{
			alert("Please enter date");
			return false;
		}
	}
</script>
<?php
    include_once 'footer.php';
	}
	else
	{
		header("Location: https://www.bccfalna.com/rm/OMS/");
	}	
?>