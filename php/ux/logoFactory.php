<?php
  /**
    $type: 0 for Letters in box, 1 for Letters next to box
  */
  function getLogo($type, $background = null, $letters = null, $topLeft = null, $topRight = null, $bottomLeft = null, $bottomRight = null, $svg = true) {
    $code = "";
    switch ($type) {
      case 0:
        $svg && $code .= "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"98 98 304 304\">";
          $background && $code .= "<path fill=\"$background\" d=\"M0 0h500v500h-500v-500\"></path>";

          $topLeft && $code .= "<path fill=\"$topLeft\" d=\"M102 102h98q2 0 2-2q0-2-2-2h-100q-2 0-2 2v100q0 2 2 2q2 0 2-2zv2q0-2 2-2z\"></path>";
          $topRight && $code .= "<path fill=\"$topRight\" d=\"M398 102v98q0 2 2 2q2 0 2-2v-100q0-2-2-2h-100q-2 0-2 2q0 2 2 2zv2q0-2-2-2z\"></path>";
          $bottomLeft && $code .= "<path fill=\"$bottomLeft\" d=\"M102 398h98q2 0 2 2q0 2-2 2h-100q-2 0-2-2v-100q0-2 2-2q2 0 2 2zv-2q0 2 2 2z\"></path>";
          $bottomRight && $code .= "<path fill=\"$bottomRight\" d=\"M398 398v-98q0-2 2-2q2 0 2 2v100q0 2-2 2h-100q-2 0-2-2q0-2 2-2zv-2q0 2-2 2z\"></path>";

          $letters && $code .= "<path style=\"mask: url(#jmask)\" fill=\"$letters\" d=\"M170 150h98q2 0 2 2v98a1 1 0 0 1-100 0q0-2 2-2h16q2 0 2 2a1 1 0 0 0 60 0v-78q0-2-2-2h-76q-2 0-2-2zh2q-2 0-2 2\" fill-rule=\"evenodd\"></path>";
          // $letters && $code .=   "<path style=\"mask: url(#jmask)\" fill=\"$letters\" d=\"M270 150v100a1 1 0 0 1-100 0q0-2 2-2h16q2 0 2 2a1 1 0 0 0 60 0v-98q0-2 2-2h16q2 0 2 2\"></path>";

          $letters && $code .= "<path id=\"n\" fill=\"$letters\" d=\"M210 202v146q0 2 2 2h16q2 0 2-2v-108l60 110h18q2 0 2-2v-148q0-2-2-2h-16q-2 0-2 2v110l-60-110h-18q-2 0-2 2\"></path>";

          $letters && $code .= "<mask id=\"jmask\">";
            $letters && $code .= "<rect width=\"500\" height=\"500\" fill=\"white\"/>";
            $letters && $code .= "<use stroke-width=\"14\" xlink:href=\"#n\" fill=\"black\" stroke=\"black\" />";
          $letters && $code .= "</mask>";
        $svg && $code .= "</svg>";
        break;
      case 1:
        $code .= "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"98 98 906.75 304\">";
          $code .=  getLogo(0, $background, null, $topLeft, $topRight, $bottomLeft, $bottomRight, false);
        $code .= "</svg>";

        break;
    }
    return $code;

  }
?>

<?php
  // header('Content-type: image/svg+xml');
  $topLeft = "#81C784";       // 300 - Green
  $topRight = "#039BE5";      // 600 - Light Blue
  $bottomLeft = "#f44336";    // 500 - Red
  $bottomRight = "#FFB74D";   // 300 - Orange

  $background = "#212121";    // 900 - Grey
  $letters = "#E0E0E0";       // 300 - Grey

  isset($_GET["tl"]) && $topLeft = $_GET["tl"];
  isset($_GET["tr"]) && $topRight = $_GET["tr"];
  isset($_GET["bl"]) && $bottomLeft = $_GET["bl"];
  isset($_GET["br"]) && $bottomLeft = $_GET["br"];

  isset($_GET["b"]) && $background = $_GET["b"];
  isset($_GET["l"]) && $letters = $_GET["l"];
?>
