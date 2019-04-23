<?php
  function db_connect($database) {
    return new mysqli("localhost", SQLUSER, SQLPASSWORD, SQLPREFIX."$database");
  }
  function db_query($conn, $query) {
    return $conn->query($query);
  }
  function db_close($conn) {
    $conn->close();
  }

  function lastId($database, $table, $id = "id", $selector = null) {
    $sql = "SELECT MAX($id) as id FROM $table";
    if(!is_null($selector))
      $sql .= " WHERE $selector";
    $q = $database->query($sql);
    if(!$q = $q->fetch_assoc())
      return 0;
    return $q["id"]+1;
  }
?>
