<!DOCTYPE html>
<html>
<head>
	<?php
		include('mystyles.css');
	?>
		<title>THEATRE CO887 - PERFORMANCE</title>
</head>

<body>
		<h1>Theatre CO887</h1>
							
		<img src="./images/16217.jpg" alt="cinemalogo">
		<p><a href="http://www.freepik.com" class="ref"/a>Designed by Katemangostar / Freepik</a></p>
	
		
	
	<?php	
		if(isset($_GET['Title'],$_GET['BasicTicketPrice'])) {
			$title = $_GET['Title'];
			$basicTicketPrice = $_GET['BasicTicketPrice'];
		}
		
		echo "<h2> Timetable for ".$title." (tickets from £ ".$basicTicketPrice.")</h2>";
				
		require 'connect.php';
		$conn = myconnect();
		$sql = "SELECT * FROM Performance WHERE Performance.Title ='$title'
				ORDER BY Performance.PerfDate
				AND Performance.PerfTime";		
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
		
		
		echo "<table><tr><th>Title</th><th>Performance Date</th><th>Performance Time</th></th><th>";
		foreach($res as $row) {
			$title;
			$basicTicketPrice;
			$perfDate = $row['PerfDate'];
			$perfTime = $row['PerfTime'];
	
			echo "<tr>";
			echo "<td>" .$title. "</td>";
			echo "<td>" .$perfDate. "</td>";
			echo "<td>" .$perfTime. "</td>";
			echo "<td><form id='Performance' action='seats.php' method='GET'>
				<input name='Title' type='hidden'  value='$title'>
				<input name='BasicTicketPrice' type='hidden' value='$basicTicketPrice'>
				<input name='PerfDate' type='hidden' value='$perfDate'>
				<input name='PerfTime' type='hidden' value='$perfTime'>
				<button name='showAvailability' type='submit' value='{$title}'>Show Availability</button>
				</form></td></tr>";
			}
		echo "</table>";
				
		
			
		
	?>
</body>
</html>