<?php
  $BREADCRUMBS["url.home"] = array();
  $BREADCRUMBS["403"] = array("breadcrumbs.error", "breadcrumbs.error_s.403");
  $BREADCRUMBS["404"] = array("breadcrumbs.error", "breadcrumbs.error_s.404");

  $BREADCRUMBS["url.login"] = array("breadcrumbs.public", "breadcrumbs.public_s.login");
  $BREADCRUMBS["url.dashboard"] = array("breadcrumbs.dashboard");
  $BREADCRUMBS["url.me"] = array("breadcrumbs.dashboard", "breadcrumbs.dashboard.me");

  function getBreadcrumbs($url) {
    global $locales, $BREADCRUMBS;
    foreach($locales[getActiveLanguage()]["url"] as $k => $u)
      if($url == $u)
        return array_merge(array("breadcrumbs.home"), $BREADCRUMBS["url.".$k]);
      report_problem("Breadcrumbs for an url were not found", getActiveLanguage(), $url);
    }

    foreach(getBreadcrumbs($url) as $crumb)
      echo locale($crumb);
?>
