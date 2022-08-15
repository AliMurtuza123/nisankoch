<?php
require_once "conn.php";
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $incuserdata = mysqli_real_escape_string($conn,$_POST['comment']);
	$userdata = str_ireplace(array('\r\n','\r','\n'),'<br>',$incuserdata);
	  
$sql = "INSERT INTO comm_data (user_data) VALUES (?)";

        if($stmt = mysqli_prepare($conn, $sql)){


mysqli_stmt_bind_param($stmt, "s", $param_userdata);


$param_userdata = $userdata;

if(mysqli_stmt_execute($stmt)){
    header("location: index.php");
}
}
}
?>