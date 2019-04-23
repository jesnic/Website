<?php
  if(!isLoggedIn())
    die("NO ACCOUNT");

  // Read parameters
  $error = getPost($id, "id", "i");
  $error = getPost($name, "name");
  $error = getPost($location, "location");
  $error = getPost($description, "description");

  $error && die("MISSING");

  // Update
  $db = db_connect("modules");
  $sql = "UPDATE modules SET name=?, location=?, description=? WHERE id=? AND owner=?";
  $q = $db->prepare($sql);
  $q->bind_param("sssii", $name, $location, $description, $id, getUserId());
  $q->execute();
  die("SUCCESS");
?>
