<?php
  require_once __DIR__."/../../php/account/notificationCenter.php";
  if(!isLoggedIn())
    die("NO ACCOUONT");

  $code = "";
  foreach(getNotifications(false) as $n)
    $code .= generateNotificationCode($n["type"]==0?"success":($n["type"]==1?"warning":($n["type"]==2?"error":"")), $n["type"]==0?$fa_box_open:"", $n["content"], date(locale("navigation.notifications.time.format"), $n["timestamp"]), $fa_times, "notification-id=\"".$n["id"]."\"");

  echo $code;
  if(strlen($code) == 0)
    echo "<div class=\"text-muted\">".locale("navigation.notifications.empty")."</div>";



  function generateNotificationCode($type, $icon, $title, $help, $action, $identifier) {
    $code  =      "<div class=\"bar $type\" $identifier>";
    $code .=        "<div class=\"icon\">";
    $code .=          $icon;
    $code .=        "</div>";
    $code .=        "<div class=\"description\">";
    $code .=          "<div class=\"title".(is_null($help)?" full":"")."\">";
    $code .=            $title;
    $code .=          "</div>";
    $code .=         "<div class=\"help\">";
    $code .=           $help;
    $code .=         "</div>";
      $code .=         "<div class=\"action\">$action</div>";
    $code .=        "</div>";
    $code .=      "</div>";
    return $code;
  }
?>
