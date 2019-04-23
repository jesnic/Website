<?php
  if(isLoggedIn())
    die("ALREADY");

  // Read parameters
  $error = getPost($email, "email");
  $error = getPost($password, "password");

  $error && die("MISSING");

  $db = db_connect("users");

  // Fetch salt
  $sql = "SELECT AES_DECRYPT(salt, '$AESKEY') as salt FROM accounts WHERE email=AES_ENCRYPT(?, '$AESKEY')";
  $q = $db->prepare($sql);
  $q->bind_param("s", $email);
  if($q->execute()) {
    if(!$q->bind_result($salt) || !$q->fetch())
      die("MISMATCH");
  } else
    die("MISMATCH");
  $q->close();

  $password = $salt.$password;

  // Actually checking
  $sql = "SELECT COUNT(id) as num FROM accounts WHERE email=AES_ENCRYPT(?, '$AESKEY') AND password=AES_ENCRYPT(SHA1(?), '$AESKEY')";
  $q = $db->prepare($sql);
  $q->bind_param("ss", $email, $password);
  $q->execute();
  $q = $q->get_result()->fetch_assoc();

  $count = $q["num"];
  if($count < 1)
    die("MISMATCH");
  if($count > 1)
    die("(╯°□°）╯︵ ┻━┻");

  // Exists -> Load data to session
  $sql = "SELECT id, AES_DECRYPT(username, '$AESKEY') as username, AES_DECRYPT(email, '$AESKEY') as email, AES_DECRYPT(firstname, '$AESKEY') as firstname, AES_DECRYPT(lastname, '$AESKEY') as lastname FROM accounts WHERE email=AES_ENCRYPT(?, '$AESKEY')";
  $q = $db->prepare($sql);
  $q->bind_param("s", $email);
  $q->execute();
  $q = $q->get_result()->fetch_assoc();

  $_SESSION["id"] = $q["id"];
  $_SESSION["username"] = $q["username"];
  $_SESSION["email"] = $q["email"];
  $_SESSION["firstname"] = $q["firstname"];
  $_SESSION["lastname"] = $q["lastname"];

  die("SUCCESS");
?>
