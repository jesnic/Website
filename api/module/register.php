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
    die("INVALID");

  $id = lastId($db, "modules");
  $sql = "INSERT INTO modules (id, token, owner, name, location, description) VALUES (?,AESENCRYPT(?, '$AESKEY'),?,'','','')";
  $q = $db->prepare($sql);
  $uid = getUserId();  // Cuz reference
  $q->bind_param("isi", $id, $token, $uid);
  $q->execute();

  // TODO: Create table

  // TODO: REDO
?>
