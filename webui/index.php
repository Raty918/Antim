<?php
session_start();
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
	<li class='active'><a href='#'>HOME</a></li>
	<?php if($_SESSION['loged']): ?>
        <!-- Logout -->      
        <li><a href='logout.php'>LOGOUT</a></li>
	<?php else: ?>
        <!-- Login Form -->
	<li><a button onclick="document.getElementById('id01').style.display='block'">LOGIN</a></li>
	<!-- The Modal -->
	<div id="id01" class="modal">
	   <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	
	   <!-- Modal Content -->
	   <form class="modal-content animate" action="/login.php" method='POST'>
  	      <div class="imgcontainer">
 	      <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
  	   </div>
 	   <div class="container">
    	      <label><b>Username</b></label>
    	      <input type="text" placeholder="Enter Username" id='username' name="username" required>
    	      <label><b>Password</b></label>
    	      <input type="password" placeholder="Enter Password" id='password' name="password" required>
    	      <button type="submit">Login</button>
    	      <input type="checkbox" checked="checked"> Remember me
          </div>
  
  	   <div class="container" style="background-color:#f1f1f1">
  	   <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
  	   <span class="psw">Forgot <a href="#">password?</a></span>
  	   </div>
	   </form>
	</div> 
	<?php endif; ?>
	</ul>
   </nav>
</header>
<div id="responsive-admin-menu">
   <div id="responsive-menu">
      <div class="menuicon">≡</div>
	</div>
           <!--Menu-->
	   <div id="menu">
               <?php if($_SESSION['loged']): ?>
	      <a href="account.php" title="Account"><span>Account</span></a>
	      <a href="signature.php" title="Signatures"><span>Signatures</span></a>
	      <a href="scan.php" title="Scan"><span>Scan</span></a>
               <?php endif; ?>

	  </div>
	<!--Menu-->
</div>
<?php if($_SESSION['loged']): ?>
<div id="content-wrapper">
	<div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
	  <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Admin Menu Content</div>
	  <div style="padding:8px;font-size:13px;"><?php include('menu.php'); ?> 
	 </div>
	</div>
	<div style="border:1px #e8e8e8 solid;width:49%;float:left;margin:10px 0px 10px 0p;">
	 <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">GRAPH</div>
	<div style="padding:8px;font-size:13px;"> <?php include("most_detected.php"); ?></div>
	</div>
	<div style="border:1px #e8e8e8 solid;width:49%;float:right;margin:10px 0px 10px 0px;">
	 <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">CHART</div>
	 <div style="padding:8px;font-size:13px;"> INSERT USEFULL CHART</div>
	</div>
</div>
<?php else: ?>
<div id="content-wrapper">
        <div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
          <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Admin Menu Content</div>
          <div style="padding:8px;font-size:13px;color:#e8101e;"><p>You have to be connected !</p></div>
        </div>
</div>
<?php endif; ?>
<footer>
<p> GOUGAM William - 2017/18 - Nagoya Institute of Technology </p>
</footer>
</body>
</html>
<?php $dbh->close();?>
