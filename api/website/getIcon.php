<?php
  require_once __DIR__."/../../php/utils/svgs.php";
  if(!isset($_POST["icon"]))
    die();

  switch($_POST["icon"]) {
    case "success":
      die($fa_check);
    case "error":
      die($fa_times);
    case "close":
      die($fa_times);
  }
?>
