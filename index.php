<?php

require_once "conn.php";
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}




$result = mysqli_query($conn,"SELECT MAX(id) AS max FROM comm_data");
$res = mysqli_fetch_array($result);
$count = $res['max'];
$count_for = $count;

for($i=$count;$i>0;$i--)
{
$getinfo = "select *from comm_data where id = '$i'";
$query = mysqli_query($conn, $getinfo);
$row = mysqli_fetch_array($query);
${"data".$i} = $row['user_data'];
${"reply".$i} = $row['reply'];

}





?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	
    <script src="script.js"></script>
    <title>Nisankoch</title>
	<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
body, input, textarea, button{
	font-family: 'Nunito Sans', sans-serif;	
}
body{
	margin:auto;
	padding-top: 150px;
    padding-bottom: 150px;
}
 
#main{
	max-width:900px;
	margin:auto;
}

#pxtg{
	display: grid;
  grid-template-columns: auto;
}

.ldmr{
	margin-top: 20px;
	display: grid;
	justify-content: center;
}
	
	.open-button {
  background-image: linear-gradient(to right, #03021f, #282a5a, #03021f);
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position:fixed;
  bottom: 100px;
  right: 28px;
  width: 280px;
  font-size: 15px;
  font-weight: 500;
}

.open-button:hover{
	opacity: 1;
}
	
	.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 30px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  background:#03021f;
}

.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container textarea {
  width: 300px;
  height: 300%;
  padding: 15px;
  margin: 1px 0 10px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container textarea:focus{
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.form-container .btn {
  background-image: linear-gradient(to right, #03021f, #282a5a, #03021f);
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 1;
  font-size: 15px;
  font-weight: 500;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
    background-image: linear-gradient(to right, #03021f, red, #03021f);

}

/* Add some hover effects to buttons */
.form-container .btn:hover {
  opacity: 0.9;
}



.logo__image{
	border-radius:2px;
	display:block;
width:165px;
margin:auto;
}

#header{
	padding: 20px 0px;
	top: 0;
	background-color:#f1f1f1;
}

 #header, #footer{
        width: 100%;
        position: fixed;        
    }
	
 #footer{
  background-image: linear-gradient(to right,#03021f, #282a5a);
	 color:white;
	 bottom: 0;
	 padding:15px 0px 15px 50px;
 }
 
 .copyright{
	 font-size: 15px;
	 font-weight: 500;
 }
 
.text{
	font-size: 16px;
	line-height: 1.6;
	font-weight: 400;
	margin: 10px 0 0 0;

}



.reply{
	border-top: solid 1px #e0dcd1;	
	padding:10px 0 0 0;
}

.count{
	font-size: 25px;
	font-weight: 700;
	color: #03021f;
	border-bottom: solid 2px #03021f;
	padding-bottom: 5px;
}

.cmnt{
	box-shadow: 0 0 10px 0 #e0dcd1; 
	padding: 20px;
	margin: 10px;
	
}

.load-more{
	padding: 15px 40px;
	line-height:1;
	border:solid 2px #03021f;
	cursor:pointer;	
}

.load-more:hover{
	background-color:#e0dcd1;
	grid-area: cell_0;
}
	</style>
</head>

<body>

<header id="header">
        <img class="logo__image" src="Nisankoch_logo.jpg" alt="nisankoch-logo" />
      
</header>	  
<main id="main">


	<section id="pxtg">
	<?php if ($count <= 0){ ?>
		<style>
		.load-more{
			display: none;
		}
		</style>
		<p>There are no comments yet</p>
	<?php }
	
	elseif($count > 0 && $count <= 10){
			
	while ($count > 0 && $count <= 10)
		{
		if (empty(${"data".$count})){
		$count--;
		continue;
	}
			?>
			<div class = "cmnt"><span class="count"><?php echo "#".$count;?></span><div class="text usr_txt"><?php echo "${"data".$count}";  ?></div>
			<?php if (!empty(${"reply".$count})) { ?><div class="text reply"><?php echo "<b>Admin Reply:</b>  "."${"reply".$count}";    ?></div><?php } ?></div>

	<?php
		$count--;
		
		}} 
	 
	else{
					for($i=$count_for;$i>$count_for-10;$i--){
				if (empty(${"data".$i})){
		continue;
	}
				?>
			<div class = "cmnt"><span class="count"><?php echo "#".$i;?></span><div class="text usr_txt" ><?php echo "${"data".$i}";  ?></div>
			<?php if (!empty(${"reply".$i})) { ?><div class="text reply"><?php echo "<b>Admin Reply:</b>  "."${"reply".$i}";    ?></div><?php } ?></div>

	<?php
			}
	
	?>
		</section>
<div class="ldmr">
<button class = "load-more" style="font-size: 15px; font-weight: 500;">Load More</button>
<input type="hidden" id="row" value="0">
</div>
	<?php 
	}
	?>
 
	

</main>

<footer id="footer">
<p class="copyright">© 2021 Nisankoch | All Rights Reserved</p>
      <button class="open-button" onclick="openForm()">Add Comment</button>
	  <div class="form-popup" id="myForm">
  <form action="addata.php" class="form-container" method="post">

    <textarea id="textarea" placeholder="Enter Your Comment!" name="comment" style="height:300px; width:270px; font-size:16px; font-weight:500px;" onblur = "checkWords()" required ></textarea>
    
 <input type="submit" class="btn" value="Submit">  
 <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>

function checkWords() {
        var my_textarea = document.getElementById('textarea').value;
        var pattern = /udhav|thakre|raj|sharad|pawar|ajit|supriya|sule|owesi|narendra|modi|amit|shah|soniya|gandhi|priyanka|yogi|adityanath|hindu|muslim|sikh|isai|islam|chatrapati|shivaji|maharaj|sambhaji|mahatma|babasaheb|ambedkar|bhimrao|prime|minister|minister|army|police|congress|mns|manase|shivsena|rashtravadi/ig;
        
        if (my_textarea.match(pattern)) {
          alert("Hey no bad words here!");
          my_textarea = my_textarea.replace(pattern, "****" );
          document.getElementById('textarea').value = my_textarea;
        }
        
      }

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
	  

</footer>

</body>
</html>
