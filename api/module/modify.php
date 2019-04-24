<?php
  if(!isLoggedIn())
    die("NO ACCOUNT");

  // Read parameters
  $error = getPost($token, "token");
  $error = getPost($name, "name");
  $error = getPost($location, "location");
  $error = getPost($description, "description");

  $error && die("MISSING");

  // Check access
  if(!doesOwnModule($token)) {
    report_suspicion("THEFT", "Foreign token request", $token);
  }

  // Update
  $db = db_connect("modules");
  $sql = "UPDATE modules SET name=?, location=?, description=? WHERE token=AES_ENCRYPT(?, '$AESKEY')";
  $q = $db->prepare($sql);
  $q->bind_param("ssss", $name, $location, $description, $token);
  $q->execute();
  die("SUCCESS");
?>
