<?php
session_start();
if(!$_SESSION['loged']){
            header('Location: index.php');
}else{
	if (!empty($_POST["file"])){
	//	$command = escapeshellcmd('/antim/scan.py -f '.$_POST["file"].'');
	$command = escapeshellcmd('python /antim/scan.py -f /antim/sample9 ');
		echo $command;
		$output = shell_exec($command);
		echo $output;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Scan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
  <h2>Scan Page</h2>
<form id='scan' action='scan.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Scan</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='file' >PathFile*:</label>
<input type='file' name='file' id='file' />
<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>
</div>
<a href="index.php" ><input type="button" value="Home" /></a>
</body>
</html>
