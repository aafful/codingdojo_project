
<?php
	session_start();
	require("connection.php");	


	$newDb = new Database();

	$query = "SELECT *FROM country";
	$countries = $newDb->fetch_all($query);

	$html = "<select id='country_name' name='country_name'>";

	foreach($countries as $country)
	{
		$html .= "<option >{$country['Name']}</option>";
	}

	$html .= "</select>";
?>

<html>
<head>
	<title>OOP Intermediate 2</title>
	<script type="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#check_info').click(function(){
				$('#get_info').submit();
			});

			 $('#get_info').submit(function() {
			 	$.post(
			 		$(this).attr('action'),
			 		$(this).serialize(),
			 		function(data) {
			 			$('#country_info').html(data.country_data.country_data);
			 		},
			 		"json"
			 	);
			 	return false;
			 });
			
			 $('#get_info').submit();
		});

	</script>
	<style type="text/css">
		#container{
			width: 700px;
			margin: auto;
		}
	</style>
</head>
<body>
	<div id = "container">
		<div>
			<form id="get_info" action="process.php" method="post">
				Select Country: <input type="hidden" name="action" value="country_select">
				<?php echo $html; ?>
				<input id = "check_info" type ="submit" value="Check Info" >
			</form>
			
		</div>
		<h3>Country Information</h3>
		<hr>
		<div id = "country_info">
		</div>		
	
	</div>
</body>
</html>