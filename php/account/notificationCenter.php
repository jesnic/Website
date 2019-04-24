<?php
  function getNotifications($seen = true) {
    global $AESKEY;
    if(!isLoggedIn())
      throw new Exception("User not logged in!");
    $db = db_connect("users");
    $sql = "SELECT nid, content, AES_DECRYPT(contentSubst, '$AESKEY'), description, AES_DECRYPT(descriptionSubst, '$AESKEY'), timestamp FROM  notifications WHERE owner=?";
    if(!$seen)
      $sql .= " AND seen = 0";
    $q = $db->prepare($sql);
    $uid = USERID;  // Cuz reference
    $q->bind_param("i", $uid);
    $q->bind_result($nid, $contentType, $contentSubst, $descriptionType, $descriptionSubst, $timestamp);
    $r = array();
    if($q->execute()) {
      while($q->fetch()) {
        $details = notificationTypeDetails($contentType);

        if(is_null($details)) {
          report_problem('$details is not defined', $contentType);
          continue;
        }

        $type = $details["type"];

        $content =      locale("notification.".$details["name"].".content");
        $description =  locale("notification.".$details["name"].".description");

        $subst = array();
        $k = null;
        foreach(explode(" ", $contentSubst) as $kk)
          if(is_null($k))
            $k = $kk;
          else
            ($subst[base64_decode($k)] = base64_decode($kk)) && $k = null;
        $contentSubst = $subst;
        $subst = array();
        $k = null;
        foreach(explode(" ", $descriptionSubst) as $kk)
          if(is_null($k))
            $k = $kk;
          else
            ($subst[base64_decode($k)] = base64_decode($kk)) && $k = null;
        $descriptionSubst = $subst;
        foreach($contentSubst as $k => $v)
          $content = str_replace($k, $v, $content);
        foreach($descriptionSubst as $k => $v)
          $description = str_replace($k, $v, $description);
        array_push($r, array("type" => $type, "id" => $nid, "content" => $content, "description" => $description, "timestamp" => $timestamp));
      }
    }
    return $r;
  }

  function notificationTypeDetails($type) {
     $r = array();
     switch ($type) {
       case 0:
        $r["type"] = "success";
        $r["name"] = "example";
      return $r;
     }
     return null;
  }

  function sendNotification($user, $type, $data) {

  }
?>
