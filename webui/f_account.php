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
	header('Location: index.php');
	}	
}
?>

