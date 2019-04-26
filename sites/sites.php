<?php
  $SITES["url.home"] = "sites/public/home.php";

  $SITES["403"] = "sites/error/403.php";
  $SITES["404"] = "sites/error/404.php";

  $SITES["url.login"] = "sites/public/login.php";
  $SITES["url.dashboard"] = "sites/dashboard/dashboard.php";
  $SITES["url.me"] = "sites/dashboard/me.php";

  function getSite($url) {
    global $locales, $SITES;
    foreach($locales[getActiveLanguage()]["url"] as $k => $u)
      if($url == $u)
        return $SITES["url.".$k];

    foreach($locales as $l => $ll)
      foreach($locales[$l]["url"] as $k => $u)
        if($url == $u)
          die("<script>window.location = (BASE + '/".$locales[getActiveLanguage()]["url"][$k]."');</script>");


    return $SITES[404];
  }

  function checkSite($url) {
    global $locales;
    foreach($locales[getActiveLanguage()]["url"] as $k => $u)
      if($url == $u)
        return;
    foreach($locales as $l => $ll)
      if($l != getActiveLanguage())
        foreach($locales[$l]["url"] as $k => $u)
          if($url == $u)
            die("<script>window.location = (BASE + '/".$locales[getActiveLanguage()]["url"][$k]."');</script><h3>".locale("redirect.redirecting")."</h3><br><br><a href=\"".URLBASE."/".$locales[getActiveLanguage()]['url'][$k]."\">".locale("redirect.pressHere")."</a></body></html>");
  }
?>
