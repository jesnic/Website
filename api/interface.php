<?php
  session_start();

  require_once "../php/config.php";
  require_once "../php/utils/http.php";
  require_once "../php/utils/sql.php";
  require_once "../php/utils/reports.php";
  require_once "../php/utils/account.php";
  require_once "../php/languages/languages.php";
  require_once "../php/utils/svgs.php";
  require_once "goals.php";

  $AESKEY = AESKEY; // More redability in SQLs

  if(!getPost($goal, "g", "i"))
    require GOALS[$goal];
?>
