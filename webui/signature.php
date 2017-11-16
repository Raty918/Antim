<?php 
session_start();
if(!$_SESSION['loged']){
	    header('Location: index.php');
}else{
	$dir = 'sqlite:/antim/db/antim.db';
        $dbh  = new PDO($dir) or die("cannot open the database");
        $query = 'SELECT * FROM signatures WHERE md5 LIKE "%'.$_POST["md5"].'%" AND filename LIKE "%'.$_POST["filename"].'%" AND filesize LIKE "%'.$_POST["filesize"].'%" AND timestamp LIKE "%'.$_POST["date"].'%";';
	echo "<table>";
	foreach($dbh->query($query) as $row){
		echo "<tr><td> md5: " . $row[0]. "</td><td> - Filename: " . $row[1]. "</td><td> - Filesize: " . $row[2]. "</td><td> - Date: " . $row[3]. "</td></tr>";
	}
	echo "</table><br>";
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
<form id='signature' action='signature.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
	<label for='md5' >MD5:</label>
	<input type='text' name='md5' id='md5'  maxlength="32" />
	<label for='filename' >Filename:</label>
	<input type='text' name='filename' id='filename'/>
	<label for='filesize' >Filesize:</label>
	<input type='number' name='filesize' id='filsize'/>
	<label for='Date' >Datetime:</label>
	<input type='text' name='date' id='date' maxlength="19" />

<input type='submit' name='Search' value='Search' />
<input type="reset">
</form>
</div>
<a href="index.php" ><input type="button" value="Home" /></a>
</body>
</html>

