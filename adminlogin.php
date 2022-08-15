<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}
 
// Include config file
require_once "conn.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: admin.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width"/>
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
	
	<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
body, input, textarea, button{
	font-family: 'Nunito Sans', sans-serif;	
}

.aform{
	box-shadow: 0 0 10px 0 #e0dcd1; 
	padding:30px;
	
}

 body{
	margin:auto;
	padding-top:150px;
    padding-bottom: 150px;
}

 #footer{
  background-image: linear-gradient(to right,#03021f, #282a5a);
	 color:white;
	 bottom: 0;
	 padding:15px 0px 15px 50px;
	 width: 100%;
     position: fixed;  
 }
 
#pxtg{
	display: grid;
	grid-template-columns: auto;
	justify-items: center;
}

.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

.logo__image{
	border-radius:2px;
	display:block;
width:165px;
margin:auto;
}

#header{
	background-color: #f1f1f1;
	padding: 20px 0px;
	top: 0;
	position: fixed;
	width: 100%;
}
.ltxt {
  width: 270px;
  height: 300%;
  padding: 15px;
  margin: 1px 0 10px 0;
  border: none;
  background: #f1f1f1;
  font-size: 16px;
  font-weight: 500;
}

.ltxt:focus{
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
</div>     
</header>

<center>
<div id="pxtg">
	<div class="aform">
	<h2>Login</h2>


				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-container" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" class="ltxt" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
			
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" class="ltxt" name="password" placeholder="Password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			
            <div class="form-group">
                <input type="submit" class="btn" value="Login">
            </div>
        
			</form>
			<br />
	</div>
</div>
	</center>
<footer id="footer">

<p class="copyright">© 2021 Nisankoch | All Rights Reserved</p>

</footer>   
</body>
</html>