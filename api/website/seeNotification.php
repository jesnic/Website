<?php
  if(!isLoggedIn())
    die("NO ACCOUONT");

  $error = getPost($notification, "notification", "i");
  $id = getUserId();

  $error && die("MISSING");

  // Mark as seen
  $db = db_connect("users");
  $sql = "UPDATE notifications SET seen = 1 WHERE owner=?";
  if($notification != -1)
    $sql .= "  AND nid=?";
  $q = $db->prepare($sql);
  if($notification != -1)
    $q->bind_param("ii", $id, $notification);
  else
    $q->bind_param("i", $id);
  $q->execute();
  die("SUCCESS");
?>
