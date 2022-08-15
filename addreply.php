<?php
require_once "conn.php";
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $aid = mysqli_real_escape_string($conn,$_POST['aid']);
      $areply = mysqli_real_escape_string($conn,$_POST['areply']);

	  
$sql = "update comm_data set reply = '$areply' where id = $aid";

if ($conn->query($sql) === TRUE) {
    header("location: adminlogin.php");
}

}

?>