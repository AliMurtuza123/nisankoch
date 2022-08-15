<?php

require_once "conn.php";
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}




$result = mysqli_query($conn,"SELECT MAX(id) AS max FROM comm_data");
$res = mysqli_fetch_array($result);
$count = $res['max'];
$row1 = $_POST['row'];

$p = $count - 10;
$y = $p - (5*($row1 - 1));

for($i = $y; $i > $y-5; $i--) { 
if($i <= 0){ ?>
	<style>
		.load-more{
			display: none;
		}
		</style>
		<p>You've read all the comments</p>
		<?php 
	break;
	
		
	}

$getinfo = "select *from comm_data where id = '$i'";
$query = mysqli_query($conn, $getinfo);
$row = mysqli_fetch_array($query);
${"data".$i} = $row['user_data'];
${"reply".$i} = $row['reply'];

if (empty(${"data".$i})){
		continue;
	}

?>
<div class = "cmnt"><span class="count"><?php echo "#".$i;?></span><div class="text usr_txt"><?php echo "${"data".$i}";  ?></div>
<?php if (!empty(${"reply".$i})) { ?><div class="text reply"><?php echo "<b>Admin Reply:</b>  "."${"reply".$i}";    ?></div><?php } ?></div>

<?php } ?>


