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
	      <a href="account.php" title="Account"><span>Account</span></a>
	<a href="signature.php" title="Signatures"><span>Signatures</span></a>
      <a href="" title="Scan"><span>Scan</span></a>
  </div>
<!--Menu-->
</div>

<div id="content-wrapper">


<div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
<div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Result</div>
  <div class="container">



<?php
  if (isset($_POST['Scan'])){
        $path="/antim/to_analyze/";
        $files = preg_grep('/^([^.])/', scandir($path));
       echo "<table>";
	foreach($files as $file) {
           $command = escapeshellcmd('python /antim/scan.py -f'.$path.''.$file.'');
           $output = shell_exec($command);
           echo '<br>'.$output.'<br>';
	}
	echo"</table>";
  }
?>




       </div>
        </div>



	<div style="border:1px #e8e8e8 solid;margin:0px 0px 10px 0px">
	  <div style="border-bottom:1px #e8e8e8 solid;background-color:#f3f3f3;padding:8px;font-size:13px;font-weight:700;color:#45484d;">Scan folder</div>
	  <div class="container">
	     <form id='scan' action='scan.php' method='post' accept-charset='UTF-8'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <input type='submit' name='Scan' value='Scan' />
             </form>

             <?php
		$path="/antim/to_analyze/";
		$files = preg_grep('/^([^.])/', scandir($path));
		echo "<table>";
		foreach($files as $file) {
			echo $file . "<br>";
		}
		echo "</table><br>"
            ?>
            </form>
          </div>
	</div>
</div>
<footer>
  <p> GOUGAM William - 2017/18 - Nagoya Institute of Technology </p>
</footer>
</body>
</html>
