<div id="sidebar">
  <div class="logo">
    <?php
      echo getLogo(1, null, "#E0E0E0", "#81C784", "#039BE5", "#f44336", "#FFB74D");
    ?>
  </div>
  <div class="tree">
    <?php
      $navigation = array(
        array(
          "icon" => ($fa_home),
          "text" => "Home",
          "href" => ""
        ),
        array(
          "icon" => $fa_dashboard,
          "text" => "Modules",
          "children" => array(
            array(
              "icon" => null,
              "text" => "Weather Module",
              "children" => array(
                array(
                  "icon" => ($fa_user),
                  "text" => "Customize",
                  "href" => "Module/1/Customize"
                )
              )
            ),
            array(
              "icon" => ($fa_envelope_open_text),
              "text" => "Customize"
            )
          )
        )
      );
      function getTreeNode($node) {
        global $fa_caret_up, $fa_caret_down;
        $code = "";
        isset($node["text"]) || $node["text"] = "";
        $code .= "<a".(isset($node["href"])?" href=\"{$node['href']}\"":" href=\"javascript:void(0);\"").">";
          isset($node["icon"]) && $code .= $node["icon"];
          $code .= "<div>{$node['text']}</div>";
          isset($node["children"]) && $code .= "<div class=\"dropper\">$fa_caret_up</div>";
        $code .= "</a>";
        isset($node["children"]) && $code .= scanTreeNodes($node["children"]);
        return $code;
      }
      echo scanTreeNodes($navigation, true);

      function scanTreeNodes($tree, $daddy = false) {
        $code = "";
        $kids = false;
        foreach($tree as $node) {
          $code .= "<li>".getTreeNode($node)."</li>";
          $kids = true;
        }
        $code .= "</ul>";
        $code = "<ul".($kids&&!$daddy?" class=\"kids\"":"").">".$code;
        return $code;
      }
    ?>
  </div>
</div>

<?php
  return;
  // Old Navigation
?>
<div id="navigation">
  <div class="top">
    <div class="container">
      <div class="row justify-content-between">
        <div class="section">
          <a href="">
            <img id="logo" src="images/icon-light.png" />
          </a>
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
                      $code .= generateBarCode("language", getActiveLanguage()==str_replace(".json", "", $file)?"active":"", $$f, locale("name", str_replace(".json", "", $file)), null, null, "language=\"".str_replace(".json", "", $file)."\"");
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
