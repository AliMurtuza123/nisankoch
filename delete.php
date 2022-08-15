<?php
require_once "conn.php";
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $aid = mysqli_real_escape_string($conn,$_POST['aid']);

	  
$sql = "delete from comm_data where id = $aid;";

if ($conn->query($sql) === TRUE) {
    header("location: adminlogin.php");
}


}

?>