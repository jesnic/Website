<?php
  function isLoggedIn() {
    return isset($_SESSION["id"]);
  }
  function getUserId() {
    return $_SESSION["id"];
  }
  if(isLoggedIn()) {
    define("FIRSTNAME", $_SESSION["firstname"]);
    define("LASTNAME", $_SESSION["lastname"]);
    define("USERID", getUserId());
  }
  function checkAccess() {
    global $ERROR;
    if(!isLoggedIn()) {
      $ERROR = "403";
    }
    return isLoggedIn();
  }

  function getActiveLanguage() {
    return isset($_COOKIE["language"])?$_COOKIE["language"]:"en";
  }
?>
