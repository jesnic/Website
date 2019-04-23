<?php
  if(!isLoggedIn())
    die("NO ACCOUONT");

  // Check if exists
  $db = db_connect("users");
  $sql = "SELECT AES_DECRYPT(value, '$AESKEY') as value FROM tokens WHERE id=?";
  $q = $db->prepare($sql);
  $uid = getUserId(); // Cuz reference
  $q->bind_param("i", $uid);
  $q->execute();
  $q = $q->get_result()->fetch_assoc();

  // Return key if exists
  if(!is_null($q))
    die($q["value"]);

  // Generate new
  $sql = "INSERT INTO tokens (id, value) VALUES (?,AES_ENCRYPT(?, '$AESKEY'))";
  $q = $db->prepare($sql);

  $charactersLength = strlen(KEYCHARS);
  $newKey = '';
  for ($i = 0; $i < KEYLENGTH; $i++)
    $newKey .= KEYCHARS[rand(0, $charactersLength - 1)];

  $q->bind_param("is", getUserId(), $newKey);
  $q->execute();
  die($newKey);
?>
