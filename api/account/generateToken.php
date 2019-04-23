<?php
  if(!isLoggedIn())
    die("NO ACCOUONT");

  // Generate new
  $db = db_connect("users");
  $sql = "UPDATE tokens SET value=AES_ENCRYPT(?, '$AESKEY') WHERE id=?";
  $q = $db->prepare($sql);

  $charactersLength = strlen(KEYCHARS);
  $newKey = '';
  for ($i = 0; $i < KEYLENGTH; $i++)
    $newKey .= KEYCHARS[rand(0, $charactersLength - 1)];

  $uid = getUserId(); // Cuz reference
  $q->bind_param("si", $newKey, $uid);
  $q->execute();
  die($newKey);
?>
