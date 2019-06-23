<!DOCTYPE html>
<html>
<head>
	
		<title>THEATRE CO887 - SEATS</title>
	<?php
		include("mystyles.css");
	?>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script> 
			function getSummary() {
				var seats = document.getElementsByClassName('SEATS');
				var selectedSeats = "";
				var totalPrice = 0;
							
				for (var i=0; i < seats.length; i++) {
					if (seats[i].checked) {
						selectedSeats += seats[i].name + " - £" + seats[i].value + "\n";
						totalPrice +=parseFloat(seats[i].value);
					}
				}
						
			alert("You have selected:\n"+ selectedSeats + "\nTOTAL = £" + parseFloat(totalPrice).toFixed(2));
			}
					
		</script>
		
		
		
</head>

<body>
		<h1>Theatre CO887</h1>
							
		<img src="./images/16217.jpg" alt="cinemalogo">
		<p><a href="http://www.freepik.com" class="ref"/a>Designed by Katemangostar / Freepik</a></p>
	
		
	
	<?php	
		if(isset($_GET['Title'],$_GET['BasicTicketPrice'],$_GET['PerfDate'],$_GET['PerfTime'])) {		
			$title = $_GET['Title'];
			$basicTicketPrice = $_GET['BasicTicketPrice'];
			$perfDate = $_GET['PerfDate'];
			$perfTime = $_GET['PerfTime'];
		}
		
		echo "<h2> Seats for ".$title." at ".$perfTime." on ".$perfDate."</h2>";
				
		echo "<h3>Review your order <button name='check' type='submit' onclick='getSummary()'>Here</button></h3>";
		
		echo "<div class='SubmitBooking'>
			<form id='booking' action='book.php' method='GET'>
				<input type='text' name='email' placeholder='Your email...'>
				<input name='Title' type='hidden'  value='$title'>
				<input name='PerfDate' type='hidden' value='$perfDate'>
				<input name='PerfTime' type='hidden' value='$perfTime'>
				<input name='selectedSeats' type='hidden' value='$selectedSeats'>
				<input name='totalPrice' type='hidden' value='$totalPrice'>
				<button id= 'book' name='book' type='submit'>Book</button>
			</form>
			</div>";
		
		
		require 'connect.php';
		$conn = myconnect();
		$sql = "SELECT Seat.RowNumber, Zone.PriceMultiplier, Seat.Zone
				FROM Seat, Zone 
				WHERE Zone.Name = Seat.Zone 
				AND Seat.RowNumber NOT IN 
				(SELECT Booking.RowNumber FROM Booking 
				WHERE Booking.PerfDate='$perfDate' 
				AND Booking.PerfTime='$perfTime')
				ORDER BY Seat.RowNumber";	
		$handle = $conn->prepare($sql);
		$handle->execute();
		$conn = null;
		$res = $handle->fetchAll();
		
		
		echo "<table><tr><th>Seat</th><th>Price</th><th></th>";
		foreach($res as $row) {
			$title;
			$basicTicketPrice;
			$perfDate;
			$perfTime;
			$zone = $row['Zone'];
			$rowNumber = $row['RowNumber'];
			$priceMultiplier = number_format($row['PriceMultiplier'],2);
			$price = number_format($basicTicketPrice*$priceMultiplier,2);
					
		echo "<tr>";
		echo "<td>" .$rowNumber. "</td>";
		echo "<td>" .$price. "</td>";
		echo "<td><form id='Seats' action='book.php' method='get'>
			<input name='Title' type='hidden'  value='$title'>
			<input name='BasicTicketPrice' type='hidden' value='$basicTicketPrice'>
			<input name='PerfDate' type='hidden' value='$perfDate'>
			<input name='PerfTime' type='hidden' value='$perfTime'>
			<input name='Zone' type='hidden' value='$zone'>
			<input name='RowNumber' type='hidden' value='$rowNumber'>
			<input name='PriceMultiplier' type='hidden' value='$priceMultiplier'>
			<input name='Price' type='hidden' value='$price'>
			<input class='SEATS' name='$rowNumber' type='checkbox' value='$price'>
			</form></td></tr>";
		}
		echo "</table>";
			
		
	?>
</body>
</html>