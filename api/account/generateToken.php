<?php
  if(!isLoggedIn())
    die("NO ACCOUONT");

  $error = getPost($length, "i");

  $error && die("MISSING");

  if($length < KEYLENGTH_MIN)
    die("S_LENGTH");
  if($length > KEYLENGTH_MAX)
    die("L_LENGTH");


  // Generate new
  $db = db_connect("modules");
  $sql = "INSERT INTO tokens (token, owner) VALUES (AES_ENCRYPT(?, '$AESKEY'), ?)";
  $q = $db->prepare($sql);

  $charactersLength = strlen(KEYCHARS);
  $newKey = '';
  for ($i = 0; $i < $length; $i++)
    $newKey .= KEYCHARS[rand(0, $charactersLength - 1)];

  $uid = getUserId(); // Cuz reference
  $q->bind_param("si", $newKey, $uid);
  $q->execute();
  die($newKey);
?>
