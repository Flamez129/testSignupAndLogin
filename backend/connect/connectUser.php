<?php

	/*** mysql hostname ***/
	$hostname = '127.0.0.1';

	/*** mysql username ***/
	$username = 'gameUser';

	/*** mysql password ***/
	$password = 'iSEDh965YlQCbY7Y';

	try {
		$conn = new PDO("mysql:host=$hostname;dbname=game", 
		                $username, $password
					   );
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e) {
		echo $e->getMessage();
		}
?>
