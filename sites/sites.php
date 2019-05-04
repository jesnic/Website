<?php
  $SITES["Home"] = "sites/public/home.php";

  $SITES["403"] = "sites/error/403.php";
  $SITES["404"] = "sites/error/404.php";

  $SITES["Login"] = "sites/public/login.php";
  $SITES["Dashboard"] = "sites/dashboard/dashboard.php";
  $SITES["Dashboard/Me"] = "sites/dashboard/me.php";

  function getSite($url) {
    global $SITES;
    return $SITES[$url];
  }
?>
