<?php
session_start();
if (!isset($_SESSION['loged'])){
	header('Location: index.php');
}
if (!empty($_POST["password"])){
	if (!empty($_POST["username"])){
	$dir = 'sqlite:/antim/db/antim.db';
	$dbh  = new PDO($dir) or die("cannot open the database");
	$query = 'UPDATE account SET email="'.$_POST["username"].'", pwd="'.$_POST["password"].'";';
	$dbh->query($query);	
	echo "Account modified";
	}	
}?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
  <h2>Account Page</h2>
<form id='account' action='account.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Account</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username'  maxlength="50" />
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" />
<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>
<a href="index.php" ><input type="button" value="HOME" /></a>
</div>
</body>
</html>
