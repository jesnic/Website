<?php
  header('Content-type: image/svg+xml');
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
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
  <path fill="<?php echo $background;?>" d="M0 0h500v500h-500v-500"></path>

  <path fill="<?php echo $topLeft;?>" d="M102 102h98q2 0 2-2q0-2-2-2h-100q-2 0-2 2v100q0 2 2 2q2 0 2-2zv2q0-2 2-2z"></path>
  <path fill="<?php echo $topRight;?>" d="M398 102v98q0 2 2 2q2 0 2-2v-100q0-2-2-2h-100q-2 0-2 2q0 2 2 2zv2q0-2-2-2z"></path>
  <path fill="<?php echo $bottomLeft;?>" d="M102 398h98q2 0 2 2q0 2-2 2h-100q-2 0-2-2v-100q0-2 2-2q2 0 2 2zv-2q0 2 2 2z"></path>
  <path fill="<?php echo $bottomRight;?>" d="M398 398v-98q0-2 2-2q2 0 2 2v100q0 2-2 2h-100q-2 0-2-2q0-2 2-2zv-2q0 2-2 2t"></path>

  <path fill="<?php echo $letters;?>" d="M170 150h98q2 0 2 2v98a1 1 0 0 1-100 0q0-2 2-2h16q2 0 2 2a1 1 0 0 0 60 0v-78q0-2-2-2h-76q-2 0-2-2zh2q-2 0-2 2" fill-rule="evenodd"></path>
  <!-- <path fill="<?php echo $letters;?>" d="M270 150v100a1 1 0 0 1-100 0q0-2 2-2h16q2 0 2 2a1 1 0 0 0 60 0v-98q0-2 2-2h16q2 0 2 2"></path> -->

  <path fill="<?php echo $letters;?>" d="M210 202v146q0 2 2 2h16q2 0 2-2v-108l60 110h18q2 0 2-2v-148q0-2-2-2h-16q-2 0-2 2v110l-60-110h-18q-2 0-2 2"></path>

  <path fill="<?php echo $background;?>" d="M230 200l60 110v-20l-50-90zm0 40l60 110v20l-60-110"></path>
  <path fill="<?php echo $background;?>" d="M210 200h-8v150h8zM230 240v110h8v-95"></path>
</svg>
