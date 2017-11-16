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
		<li><a href='logout.php'>LOGOUT</a></li>
		<li><a href='signature.php'>SIGNATURE</a></li>
		<li><a href='scan.php'>SCAN</a></li>
		<li><a href='account.php'>ACCOUNT</a></li>
	<?php else: ?>
		<li><a href='login.php'>LOGIN</a></li>
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
	      <a href="" title="Dashboard"><span>Dashboard</span></a>
	      <a href="" title="News"><span>News</span></a>
	      <a href="" title="Pages"><span> Pages</span></a>
	      <a href="" title="Results"><span>Results</span></a>
	  </div>
	<!--Menu-->
</div>
<div id="content-wrapper">
	<div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
	  <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Admin Menu Content</div>
	  <div style="padding:8px;font-size:13px;">TEXT</div>
	</div>
	<div style="border:1px #e8e8e8 solid;width:49%;float:left;margin:10px 0px 10px 0px">
	 <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">GRAPH</div>
	 <div style="padding:8px;font-size:13px;">GRAPH</div>
	</div>
	<div style="border:1px #e8e8e8 solid;width:49%;float:right;margin:10px 0px 10px 0px">
	 <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">CHART</div>
	 <div style="padding:8px;font-size:13px;"> INSERT USEFULL CHART</div>
	</div>
</div>
</body>
</html>
