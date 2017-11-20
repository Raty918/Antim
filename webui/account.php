<?php
session_start();
if(!$_SESSION['loged']){
   header('Location: index.php');
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
	      <a href="" title="Account"><span>Account</span></a>
	      <a href="signature.php" title="Signatures"><span>Signatures</span></a>
	      <a href="scan.php" title="Scan"><span>Scan</span></a>
	  </div>
	<!--Menu-->
</div>
<div id="content-wrapper">
	<div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
	  <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Modify Account</div>
	  <div class="container">
            <form id='account' action='f_account.php' method='post' accept-charset='UTF-8'>
              <input type='hidden' name='submitted' id='submitted' value='1'/>
              <label><b>Username</b></label>
              <input type="text" placeholder="Enter Username" id='username' name="username" required>
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" id='password' name="password" required>
              <button type="submit">Modify</button>
            </form>
          </div>
	</div>
</div>
<footer>
  <p> GOUGAM William - 2017/18 - Nagoya Institute of Technology </p>
</footer>
</body>
</html>
