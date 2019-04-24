<?php
  function report_problem($content, ...$data) {
    $bt = debug_backtrace();
    $trace = $bt[0]["file"].":".$bt[0]["line"];
    $d = "";
    foreach($data as $da => $ta)
      $d .= ",$da -> $ta";
    $d = substr($d, 1);
    $sql = "INSERT INTO problems (id, timestamp, content, data, file) VALUES (?,?,?,?,?)";
    $db = db_connect("users");
    $q = $db->prepare($sql);
    $lid = lastId($db, "problems"); // Cuz reference
    $t = time();
    $q->bind_param("iisss", $lid, $t, $content, $d, $trace);
    $q->execute();
  }

  function report_suspicion($death, $content, ...$data) {
    $bt = debug_backtrace();
    $trace = $bt[0]["file"].":".$bt[0]["line"];
    $d = "";
    foreach($data as $da => $ta)
      $d .= ",$da -> $ta";
    $d = substr($d, 1);
    $sql = "INSERT INTO suspicions (id, timestamp, user, content, data, file) VALUES (?,?,?,?,?,?)";
    $db = db_connect("users");
    $q = $db->prepare($sql);
    $lid = lastId($db, "suspicions"); // Cuz reference
    $t = time();
    $uid = isLoggedIn()?getUserId():-1;
    $q->bind_param("iiisss", $lid, $t, $uid, $content, $d, $trace);
    $q->execute();
    if(!is_null($death))
      die($death);
  }
?>
