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

  function doesOwnModule($token) {
    if(!isLoggedIn())
      return false;
    $db = db_connect("modules");
    $sql = "SELECT 0 FROM tokens WHERE token = AES_ENCRYPT(?, '$AESKEY') AND owner = ?";
    $q =  $db->prepare($sql);
    $uid = getUserId(); // Reference
    $q->bind_paarm("si", $token, $uid);
    if(!$q = $q->fetch_assoc()) 
      return false;
    return true;
  }
?>
