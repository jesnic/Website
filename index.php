<!doctype html>
<?php
  session_start();
?>
<html>
  <head>
    <?php
      require_once "php/config.php";
      require_once "php/utils/sql.php";
      require_once "php/utils/reports.php";
      require_once "php/utils/account.php";
      require_once "php/utils/svgs.php";
      require_once "php/languages/languages.php";
      require_once "php/account/notificationCenter.php";
      require_once "sites/sites.php";

      $url = isset($_GET["url"])?$_GET["url"]:"Home";
      echo "<script>const BASE = '".URLBASE."'</script>\n";
      $AESKEY = AESKEY;
    ?>
    <base href="<?php echo URLBASE."/"; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time();?>">
  </head>
  <body>
    <?php
      require "sites/elements/navigation.php";
      require "sites/elements/breadcrumbs.php";

      if(!@include getSite($url))
        $ERROR = "404";
      if(isset($ERROR))
        require_once $SITES[$ERROR];
    ?>
    <div id="toasts"></div>
    <div id="repos"><div id="icon_repo_close">
        <?php
          echo $fa_times;
        ?></div><div id="icon_repo_success">
        <?php
          echo $fa_check;
        ?></div><div id="icon_repo_error">
        <?php
          echo $fa_times;
        ?></div></div>
    <script src="js/jquery/jquery-3.3.1.min.js"></script>
    <script src="js/jquery/cookie.js"></script>
    <script src="js/js.js?<?php echo time();?>"></script>
  </body>
</html>
