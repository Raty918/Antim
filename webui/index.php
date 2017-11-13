<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>HOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
   <h2>Home</h2>
   <?php if($_SESSION['loged']): ?>
      <a href="logout.php" ><input type="button" value="Logout" /></a>
      <a href="signature.php" ><input type="button" value="Signatures"/></a>
      <a href="scan.php" ><input type="button" value="Scan"/></a>
   <?php else: ?>
      <a href="login.php" ><input type="button" value="Login" /></a>
   <?php endif; ?>
</div>
</body>
</html>
