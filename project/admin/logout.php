<?php
// Unset and expire the cookies
setcookie("loggedin", "", time() - 3600, "/");
setcookie("user_id", "", time() - 3600, "/");
setcookie("user_type", "", time() - 3600, "/");

header("location:index.php");
