<?php
session_start();
if(!$_SESSION['loged']){
       	header('Location: index.php');
}else{
        $dir = 'sqlite:/antim/db/antim.db';
	$dbh  = new PDO($dir) or die("cannot open the database");

	/* Number of detected signatures*/
	$query1 = 'SELECT COUNT(DISTINCT md5) FROM signatures;';
	$result1 = $dbh->query($query1);

	/*Date of the last scan*/
	$query2 = 'SELECT timestamp from signatures ORDER BY timestamp DESC LIMIT 1;';
	$result2 = $dbh->query($query2);

	/* last file scanned */
	$query3 = 'SELECT md5, filename  from signatures ORDER BY timestamp DESC LIMIT 1;';
	$result3 = $dbh->query($query3);	
	 
}
?>
	<b> Number of signatures: </b> <div style="color:#18a510;"> <?php foreach($result1 as $row){ echo $row["0"];} ?></div><br>
        <b> Last analyze: </b> <div style="color:#18a510;"> <?php foreach($result2 as $row){ echo $row["0"];} ?></div><br>
        <b> Last file analyzed: </b> <div style="color:#18a510;"> <?php foreach($result3 as $row){ echo $row["0"]." | ".$row["1"];} ?></div><br> 

