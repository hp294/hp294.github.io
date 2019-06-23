<!DOCTYPE html>
<html>
<head>
	<?php
		include('mystyles.css');
	?>
		<title>THEATRE CO887</title>
</head>

<body>
		<h1>Theatre CO887</h1>
							
		<img src="./images/16217.jpg" alt="cinemalogo">
		<p><a href="http://www.freepik.com" class="ref"/a>Designed by Katemangostar / Freepik</a></p>
		
		<h2> Upcoming Shows</h2>
		
	<?php 
		require 'connect.php';
		$conn = myconnect();
		$sql = "SELECT * FROM Production
				ORDER BY Production.Title";
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
		
		
		echo "<table><tr><th>Title</th><th>Tickets From</th></th><th>";
		foreach($res as $row) {
			$title = $row['Title'];
			$basicTicketPrice = number_format($row['BasicTicketPrice'],2);
	
			echo "<tr>";
			echo "<td>" .$title. "</td>";
			echo "<td>" .$basicTicketPrice. "</td>";
			echo "<td><form id='Production' action='perf.php' method='GET'>
				<input name='Title' type='hidden'  value='$title'>
				<input name='BasicTicketPrice' type='hidden' value='$basicTicketPrice'>
				<button name='showPerformance' type='submit' value='{$title}'>Show Performance</button>
				</form></td></tr>";
			}
		echo "</table>";
	
	// Validation
	//https://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete
	//Task 1: configuring table and add set variable
	//Task 2: button link issue, only link and not passing data
	//Task 3: name in form not match with name in database
	?>
	
	
	
	
</body>
</html>