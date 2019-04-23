<?php
  function problem($content, ...$data) {
    var_dump(func_get_args());
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
?>
