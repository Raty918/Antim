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
      die(header("location:index.php"));
      }	
}
?>
