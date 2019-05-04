<?php
  $BREADCRUMBS["Home"] = array();
  $BREADCRUMBS["403"] = array("breadcrumbs.error", "breadcrumbs.error_s.403");
  $BREADCRUMBS["404"] = array("breadcrumbs.error", "breadcrumbs.error_s.404");

  $BREADCRUMBS["Login"] = array("breadcrumbs.public_s.login");
  $BREADCRUMBS["Dashboard"] = array("breadcrumbs.dashboard");
  $BREADCRUMBS["Dashboard/Me"] = array("breadcrumbs.dashboard", "breadcrumbs.dashboard_s.me");

  function getBreadcrumbs($url) {
    global $BREADCRUMBS;
    return array_merge(array("breadcrumbs.home"), $BREADCRUMBS[$url]);
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
