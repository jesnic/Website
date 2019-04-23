<?php
  if(!isLoggedIn())
    die("NO ACCOUNT");

  // Read parameters
  $error = getPost($name, "token");

  $error && die("MISSING");

  /*
    Type 00 => Temperature
    Type 01 => Humidity
   */

  // Insert into db
  $db = db_connect("modules");
  if(lastId($db, "modules", "id", "token = AES_ENCRYPT(?, '$AESKEY'") != 0)
    die("EXISTING");

  $id = lastId($db, "modules");
  $sql = "INSERT INTO modules (id, token, owner, name, location, description) VALUES (?,AESENCRYPT(?, '$AESKEY'),?,'','','')";
  $q = $db->prepare($sql);
  $uid = getUserId();  // Cuz reference
  $q->bind_param("isi", $id, $token, $uid);
  $q->execute();
  $sql = "CREATE TABLE m_".intval($id)." (timestamp INT NOT NULL, 0 INT, 1 INT);";
  $q = $db->prepare($sql);
  $q->execute();
  die("SUCCESS");
?>
