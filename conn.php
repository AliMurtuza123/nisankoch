<?php
	$conn = mysqli_connect('localhost', '<username>', '<password>', '<db Name>') or die(mysqli_error());
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>