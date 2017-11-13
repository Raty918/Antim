<?php 
session_start();
if(!$_SESSION['loged']){
	    header('Location: index.php');
}else{
	$dir = 'sqlite:/antim/db/antim.db';
        $dbh  = new PDO($dir) or die("cannot open the database");
        $query = 'SELECT * FROM signatures;';
	$count=1;
	foreach($dbh->query($query) as $row){
		echo "#".$count."<br>";
		echo "md5: " . $row[0]. " - Filename: " . $row[1]. " - Filesize: " . $row[2]. "<br>";
		$count++;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
<form action="index.php">
    <input type="submit" value="Home" />
</form>
</div>
</body>
</html>

