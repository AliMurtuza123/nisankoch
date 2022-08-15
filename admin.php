<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<title>Nisankoch Admin</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
body, input, textarea, button{
	font-family: 'Nunito Sans', sans-serif;	
}
.logo__image{
	border-radius:2px;
width:165px;

}

.inner-header{
	max-width: 1140px;
	margin: auto;
}

#header{
	 background-color: #f1f1f1;
	 top: 0;
	 padding:20px 0 0 0;
	 width: 100%;
     position: fixed;  
}
	
 #footer{
  background-image: linear-gradient(to right,#03021f, #282a5a);
	 color:white;
	 bottom: 0;
	 padding:15px 0px 15px 50px;
	 width: 100%;
     position: fixed;  
 }
 
 body{
	margin:auto;
	padding-top:150px;
    padding-bottom: 150px;
}
 
 #main{
	max-width:1140px;
	margin:auto;
}

.ltbtn{
float: right;
padding: 15px 50px;
right: 5px;
border:  solid 2px #03021f;
font-size:16px;
font-weight:500;
line-height:1;
cursor:pointer;
}

.ltbtn:hover{
	background-color:#e0dcd1;
}

#pxtg{
	display: grid;
  grid-template-columns: auto auto;
  justify-items: center;
}

@media only screen and (max-width: 600px) {
.ltbtn{
float: none;
position:fixed;
right:0;
margin-right: 10px;
}
#pxtg{
	display: grid;
  grid-template-columns: auto;
  justify-items: center;
}


#header{
	 background-color: #f1f1f1;
	 top: 0;
	 padding:20px 10px 0 10px;
	 width: 100%;
     position: fixed;  
}
.aform{
margin-bottom:30px;
}
}

.aform{
	box-shadow: 0 0 10px 0 #e0dcd1; 
	padding:30px;
}

.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container textarea {
  width: 270px;
  height: 300%;
  padding: 15px;
  margin: 1px 0 10px 0;
  border: none;
  background: #f1f1f1;
}

.aid {
  width: 270px;
  height: 300%;
  padding: 15px;
  margin: 1px 0 10px 0;
  border: none;
  background: #f1f1f1;
  font-size: 16px;
  font-weight: 500;
}

.aid:focus{
  background-color: #ddd;
}

/* When the inputs get focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
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

h2{
	margin-left:10px;
	font-size:22px;
	font-weight:600;
	color: #03021f;
}
</style>
</head>

<body>
<header id="header">
<div class="inner-header">
<img class="logo__image" src="Nisankoch_logo.jpg" alt="nisankoch-logo" />
<button class="ltbtn" onclick="window.location.href = 'logout.php';">Logout</button><br><br>
</div>     
</header>	  
<main id="main">


<div id="pxtg">
<div class="aform">
<h2>Reply to Comment</h2>
<form action="addreply.php" class="form-container" method="post">
  <input type="number" class="aid" id="aid" name="aid" placeholder="Please Enter ID"><br>
  <textarea id="areply" name="areply" placeholder="Please Enter Reply" style="height:200px; font-size:16px; font-weight:500px;"></textarea><br>
  <input type="submit" class="btn" value="Add Reply">
</form>
</div>

<div class="aform">
<h2>Delete a Comment</h2>
<form action="delete.php" class="form-container" method="post">
  <input type="number" id="aid" class="aid" name="aid" placeholder="Please Enter ID"><br>
 
  <input type="submit" class="btn" value="Delete">
</form>
</div>
</div>
</main>
<footer id="footer">

<p class="copyright">© 2021 Nisankoch | All Rights Reserved</p>

</footer>
</body>
</html>