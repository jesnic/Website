<?php
  if(!isLoggedIn())
    die("NO ACCOUNT");

  // Read parameters
  $error = getPost($name, "name");
  $error = getPost($type, "type", "i");

  $error && die("MISSING");

  /*
    Type 00 => Temperature
    Type 01 => Humidity
   */

  // Insert into db
  $db = db_connect("modules");
  $sql = "SELECT MAX(id) as idM FROM modules";
  $q = $db->prepare($sql);
  $q->execute();
  $q = $q->get_result()->fetch_assoc();
  $idM = $q["idM"] + 1;
  $sql = "INSERT INTO modules (id, owner, name, location, description, type) VALUES (?,?,?,'','',?)";
  $q = $db->prepare($sql);
  $q->bind_param("iisi", $idM, getUserId(), $name, $type);
  $q->execute();
  $sql = "CREATE TABLE m_".intval($idM)." (timestamp INT NOT NULL, value INT NOT NULL);";
  $q = $db->prepare($sql);
  $q->execute();
  die("SUCCESS");
?>
