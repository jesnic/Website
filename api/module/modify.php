<?php
  if(!isLoggedIn())
    die("NO ACCOUNT");

  // Read parameters
  $error = getPost($token, "token");
  $error = getPost($name, "name");
  $error = getPost($location, "location");
  $error = getPost($description, "description");

  $error && die("MISSING");

  // Update
  $db = db_connect("modules");
  $sql = "UPDATE modules SET name=?, location=?, description=? WHERE token=AES_ENCRYPT(?, '$AESKEY') AND owner=?";
  $q = $db->prepare($sql);
  $q->bind_param("ssssi", $name, $location, $description, $token, getUserId());
  $q->execute();
  die("SUCCESS");



  // TODO: REDO
?>
