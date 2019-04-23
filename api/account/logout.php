<?php
  setcookie("PHPSESSID", "", time()-3600, "/");
  session_destroy();
  die("SUCCESS");
?>
