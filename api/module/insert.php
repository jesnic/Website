<?php
  // Read parameters
  $error = getPost($token, "token");

  $error && die("MISSING");
  $data = array();
  foreach(array_diff(array_keys($_POST), array("g", "token")) as $k)
    $data[$k] = $_POST[$k];

  !count($data) && die("DATA");

  // Get ID
  $db = db_connect("modules");
  $sql = "SELECT id FROM modules WHERE token = AES_ENCRYPT(?, '$AESKEY')";
  $q = $db->prepare($sql);
  $q->bind_param("s", $token);
  if($q->execute()) {
    if(!$q->bind_result($id) || !$q->fetch())
      report_suspion("INVALID", "Invalid token passed", $token);
  } else
    report_suspion("INVALID", "Invalid token passed", $token);
  $q->close();

  // Form SQL
  $sql = "INSERT INTO m_$id (timestamp,";
  foreach($data as $k => $v)
    $sql .= "`$k`,";
  $sql = rtrim($sql, ",");
  $sql .= ") VALUES (?,";
  foreach($data as $k => $v)
    $sql .= "AES_ENCRYPT(?,'$AESKEY'),";
  $sql = rtrim($sql, ",");
  $sql .= ")";

  // Feed values
  $q = $db->prepare($sql);
  $t = time();   // Reference
  $v = array_values($data);   // Reference
  $q->bind_param("i".str_repeat("i", count($data)), $t, $v);
  $q->execute();
  die("SUCCESS");
?>
