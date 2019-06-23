<!DOCTYPE html>
<html>
<head>
	<?php
		include("mystyles.css");
	?>
		<title>THEATRE CO887 - SEATS</title>
						
</head>

<body>
		<h1>Theatre CO887</h1>
							
		<img src="./images/16217.jpg" alt="cinemalogo">
		<p><a href="http://www.freepik.com" class="ref"/a>Designed by Katemangostar / Freepik</a></p>
			
	
	<?php
		if(isset($_GET['Title'],$_GET['BasicTicketPrice'],$_GET['PerfDate'],$_GET['PerfTime'],$_GET['selectedSeats'],$_GET['totalPrice'])) {		
			$title = $_GET['Title'];
			$perfDate = $_GET['PerfDate'];
			$perfTime = $_GET['PerfTime'];
			$selectedSeats = $_GET['selectedSeats'];
			$totalPrice = $_GET['totalPrice'];
		}
		
		echo nl2br("<h2>CONFIRMATION\nTitle: ".$title."\nDate: ".$perfDate."\nTime: ".$perfTime."\nSeat: ".$selectedSeats."\nTotal Price: ".$totalPrice."</h2>");
		
		
	?>
</body>
</html>