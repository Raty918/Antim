<?php

<!-- Modal Content -->
<form class="modal-content animate" action="/login.php" method='POST'>
  <div class="imgcontainer">
  <img src="img_avatar2.png" alt="Avatar" class="avatar">
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

?>
