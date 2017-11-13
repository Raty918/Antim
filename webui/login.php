<?php
session_start();
if (isset($_SESSION['loged'])){
	header('Location: index.php');
}
if (!empty($_POST["password"])){
	if (!empty($_POST["username"])){
	$dir = 'sqlite:/antim/db/antim.db';
	$dbh  = new PDO($dir) or die("cannot open the database");
	$query = 'SELECT * FROM account WHERE email="'.$_POST["username"].'" AND pwd="'.$_POST["password"].'";';
	
	foreach($dbh->query($query) as $row){
		if (($row[0] == $_POST["username"]) && ($row[1] == $_POST["password"])){
			$_SESSION['loged']=True;
			header('Location: index.php');	
		}
	}
	echo "BAD CREDENTIALS";
	}	
}?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log in</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
  <h2>Login Page</h2>
  
<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Login</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username'  maxlength="50" />
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" />
<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>
</div>
</body>
</html>
