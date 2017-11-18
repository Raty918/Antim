<?php
session_start();
if(!$_SESSION['loged']){
   header('Location: index.php');
}else{
	$dir = 'sqlite:/antim/db/antim.db';
	$dbh  = new PDO($dir) or die("cannot open the database");
	$query = 'SELECT * FROM signatures WHERE md5 LIKE "%'.$_POST["md5"].'%" AND filename LIKE "%'.$_POST["filename"].'%" AND filesize LIKE "%'.$_POST["filesize"].'%" AND timestamp LIKE "%'.$_POST["date"].'%";';
	$result=$dbh->query($query);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>HOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <nav id='cssmenu'>
	<div class="logo"><a href="index.php">Admin Dashboard</a></div>
	<div id="head-mobile"></div>
	<div class="button"></div>
	<ul>
	<li class='active'><a href='index.php'>HOME</a></li>
	<!-- Logout -->      
        <li><a href='logout.php'>LOGOUT</a></li>
 
	</ul>
   </nav>
</header>
<div id="responsive-admin-menu">
   <div id="responsive-menu">
      <div class="menuicon">≡</div>
   </div>
           <!--Menu-->
	   <div id="menu">
	      <a href="account.php" title="Account"><span>Account</span></a>
	      <a href="" title="Signatures"><span>Signatures</span></a>
	      <a href="scan.php" title="Scan"><span>Scan</span></a>
	  </div>
	<!--Menu-->
</div>
<div id="content-wrapper">
	<div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
	  <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Signature Reasearch</div>
	  <div class="container">
             <?php
                echo "<table>";
		foreach($result as $row){
	            echo "<tr><td> md5: " . $row[0]. "</td><td> - Filename: " . $row[1]. "</td><td> - Filesize: " . $row[2]. "</td><td> - Date: " . $row[3]. "</td></tr>";
                }
                echo "</table><br>";
            ?>
            <form id='signature' action='signature.php' method='post' accept-charset='UTF-8'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <label for='md5' >MD5:</label>
               <input type='text' name='md5' id='md5'  maxlength="32" />
               <label for='filename' >Filename:</label>
               <input type='text' name='filename' id='filename'/>
               <label for='filesize' >Filesize:</label><br>
	       <input type='number' name='filesize' id='filsize'/><br><br>
               <label for='Date' >Datetime:</label>
               <input type='text' name='date' id='date' maxlength="19" />
               <input type='submit' name='Search' value='Search' />
               <input type="reset">
            </form>
          </div>
	</div>
</div>
<footer>
  <p> GOUGAM William - 2017/18 - Nagoya Institute of Technology </p>
</footer>
</body>
</html>
