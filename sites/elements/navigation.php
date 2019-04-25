<div id="navigation">
  <div class="top">
    <div class="container">
      <div class="row justify-content-between">
        <div class="section">
          a
        </div>
        <div class="section">
          <?php
            $code = "";
            if(isLoggedIn()) {
              // Notifications
              $code .= "<div class=\"item notifications\">";
                $code .= $fa_envelope_open_text;
                $code .= "<div class=\"dropdown\">";
                  $code .= "<div class=\"header\">";
                    $code .= "<h3 class=\"title\">".locale("navigation.notifications.header")."</h3>";
                  $code .= "</div>";
                  $code .= "<div class=\"body\">";
                    $code .= "<div class=\"bars\" id=\"notificationSpace\">";
                      $code .= "<div class=\"text-muted\">";
                        $code .= locale("navigation.notifications.loading");
                      $code .= "</div>";
                    $code .= "</div>";
                  $code .= "</div>";
                $code .= "</div>";
              $code .= "</div>";
            }
            // Languages
            $code .= "<div class=\"item languages\">";
                        $f = 'flag_'.getActiveLanguage();
              $code .= $$f;
              $code .= "<div class=\"dropdown languages\">";
                $code .= "<div class=\"body\">";
                  $code .= "<div class=\"bars languages\">";
                  foreach (array_diff(scandir(__DIR__."/../../php/languages/locales"), array(".", "..")) as $file) { $f = "flag_".str_replace(".json", "", $file);
                      $code .= generateBarCode("language", "", $$f, locale("name", str_replace(".json", "", $file)), null, null, "language=\"".str_replace(".json", "", $file)."\"");
                    }
                  $code .= "</div>";
                $code .= "</div>";
              $code .= "</div>";
            $code .= "</div>";

            // User Actions
            $code .= "<div class=\"item user\">";
              if(isLoggedIn())
              $code .=    $fa_user;
              else
              $code .=    $fa_user;
              $code .= "<div class=\"dropdown\">";
              if(isLoggedIn()) {
                $code .= "<div class=\"header\">";
                  $code .= "<h3 class=\"title\">".str_replace("%f%", FIRSTNAME, str_replace("%l%", LASTNAME, locale("navigation.profile.nameFormat")))."</h3>";
                $code .= "</div>";
                $code .= "<div class=\"body\">";
                  $code .= "<div class=\"bars\">";
                    $code .= generateBarCode("_url.me", "me", $fa_profile, "_navigation.profile.myProfile.title", "_navigation.profile.myProfile.description", $fa_goto);
                    $code .= generateBarCode("_url.dashboard", "dashboard", $fa_dashboard, "_navigation.profile.dashboard.title", "_navigation.profile.dashboard.description", $fa_goto);
                    $code .= generateBarCode("_url.inbox", "inbox", $fa_inbox, "_navigation.profile.inbox.title", "_navigation.profile.inbox.description", $fa_goto);
                    $code .= generateBarCode("logout", "logout", $fa_sign_out, "_navigation.profile.logout.title", null, $fa_goto);
                  $code .= "</div>";
                $code .= "</div>";
              } else {
                $code .= "<div class=\"header\">";
                  $code .= "<h3 class=\"title\">".locale("navigation.profile.headerNew")."</h3>";
                $code .= "</div>";
                $code .= "<div class=\"body\">";
                  $code .= "<div class=\"bars\">";
                    $code .= generateBarCode("_url.login", "login", $fa_sign_in, "_navigation.profile.login.title", null, $fa_goto);
                  $code .= "</div>";
                $code .= "</div>";
              }
              $code .=    "</div>";
            $code .=  "</div>";

            echo $code;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  function generateBarCode($target = null, $type, $icon = null, $title, $help = null, $action = null, $identifier = null) {
    !is_null($target) && substr($target, 0, 1) == "_" && $target = locale(substr($target, 1));
    !is_null($title) && substr($title, 0, 1) == "_" && $title = locale(substr($title, 1));
    !is_null($help) && substr($help, 0, 1) == "_" && $help = locale(substr($help, 1));

    $indentifier = isset($indentifier)?" ".$indentifier:"";
    !is_null($target) && $type .= " hyperlink";
    !is_null($target) && $target = " href=\"$target\"";
    $code  =      "<div class=\"bar $type\"$target $identifier>";
    $code .=        "<div class=\"icon\">";
    $code .=          $icon;
    $code .=        "</div>";
    $code .=        "<div class=\"description\">";
    $code .=          "<div class=\"title".(is_null($help)?" full":"")."\">";
    $code .=            $title;
    $code .=          "</div>";
    if(!is_null($help)) {
      $code .=         "<div class=\"help\">";
      $code .=           $help;
      $code .=         "</div>";
    }
    if(!is_null($action))
      $code .=         "<div class=\"action\">$action</div>";
    $code .=        "</div>";
    $code .=      "</div>";
    return $code;
  }
?>
