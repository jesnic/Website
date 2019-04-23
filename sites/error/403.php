<h1 style="text-align: center"><?php echo locale("error.403.title"); ?></h1><br>
<h3 style="text-align: center"><?php echo str_replace("%s%", urldecode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"), locale("error.403.description")); ?></h3>
