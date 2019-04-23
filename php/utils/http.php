<?php
  require_once "text.php";

  /**
   * Safely fetch _POST variables
   * @param  mixed   &$var     Variable to be filled
   * @param  string  $val      _POST index
   * @param  string  $type     Return type (default: s)
   * @param  boolean $required Retusn true if not found
   * @return mixed              if $required == true true if not found, else null or the desired value
   */
  function getPost(&$var, $val, $type = "s", $required = true) {
    if(!isset($_POST[$val]) && $required)
      return true;
    switch ($type) {
      case 'i':
      $var = intval($_POST[$val]);
      break;
      case 's':
      $var = safetext($_POST[$val]);
      break;
    }
  }
?>
