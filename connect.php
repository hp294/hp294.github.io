<?php
function myconnect() { 
	$host = 'dragon.ukc.ac.uk';
	$dbname = 'hp294';
	$user = 'hp294';
	$pwd = 't&latez';
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($conn) {
			return $conn;
		} else {
			echo 'Failed to connect';
		}
	} catch (PDOException $e) {
		echo "PDOException: ".$e->getMessage();
	}
return $conn;} 

?>