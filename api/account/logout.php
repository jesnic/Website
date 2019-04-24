<?php
  if(!isLoggedIn())
    report_suspicion("NOT LOGGED", "User is not logged in");
  setcookie("PHPSESSID", "", time()-3600, "/");
  session_destroy();
  die("SUCCESS");
?>
