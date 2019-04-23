<?php
  $locales = array();
  foreach (array_diff(scandir(__DIR__."/locales"), array(".", "..")) as $file) {
    $texts = json_decode(file_get_contents(__DIR__."/locales/$file"), true);
    $locales[str_replace(".json", "", $file)] = $texts;
  }

  function locale($name, $language = null) {
    global $locales;
    is_null($language) && $language = getActiveLanguage();
    $name = explode(".", $name);
    $node = $locales[$language];
    while(count($name) > 0)
      if(($node = $node[array_shift($name)]) == null) {
        return "Index not found";
      }
    return $node;
  }
?>
