<?php
  $BREADCRUMBS["url.home"] = array();
  $BREADCRUMBS["403"] = array("breadcrumbs.error", "breadcrumbs.error_s.403");
  $BREADCRUMBS["404"] = array("breadcrumbs.error", "breadcrumbs.error_s.404");

  $BREADCRUMBS["url.login"] = array("breadcrumbs.public", "breadcrumbs.public_s.login");
  $BREADCRUMBS["url.dashboard"] = array("breadcrumbs.dashboard");
  $BREADCRUMBS["url.me"] = array("breadcrumbs.dashboard", "breadcrumbs.dashboard_s.me");

  function getBreadcrumbs($url) {
    global $locales, $BREADCRUMBS;
    foreach($locales[getActiveLanguage()]["url"] as $k => $u)
      if($url == $u)
        return array_merge(array("breadcrumbs.home"), $BREADCRUMBS["url.".$k]);
      report_problem("Breadcrumbs for an url were not found", getActiveLanguage(), $url);
    }
?>
<div id="breadcrumbs">
  <div class="wrapper">
    <?php
      $crumbs = getBreadcrumbs($url);

      for($i = 0; $i < count($crumbs)-1; $i++)
        echo "<a class=\"breadcrumb\">".locale($crumbs[$i])."</a><span class=\"separator\">$fa_breadcrumbs_separator</span>";
        echo "<a class=\"breadcrumb active\">".locale($crumbs[count($crumbs)-1])."</a>";
        ?>
  </diV>
</div>
