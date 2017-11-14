<?php
session_start();
if(!$_SESSION['loged']){
            header('Location: index.php');
}else{
	if (isset($_POST['Scan'])){
		$path="/antim/to_analyze/";
		$files = preg_grep('/^([^.])/', scandir($path));
		foreach($files as $file) {
		$command = escapeshellcmd('python /antim/scan.py -f'.$path.''.$file.'');
		$output = shell_exec($command);
		echo '<br>'.$output.'<br>';
		}
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
  <h2>Scan Page (folder to_analyze)</h2>
<form id='scan' action='scan.php' method='post' accept-charset='UTF-8'>
<fieldset>
<legend>Scan</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='submit' name='Scan' value='Scan' />
</fieldset>
</form>
</div>
<a href="index.php" ><input type="button" value="Home" /></a>
</body>
</html>
