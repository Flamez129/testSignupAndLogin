<?php

	/*** mysql hostname ***/
	$hostname = '127.0.0.1';

	/*** mysql username ***/
	$username = 'hassanUser';

	/*** mysql password ***/
	$password = 'cE2h478QdvXcTPOc';

	try {
		$conn = new PDO("mysql:host=$hostname;dbname=hassan", 
		                $username, $password
					   );
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e) {
		echo $e->getMessage();
		}
?>
