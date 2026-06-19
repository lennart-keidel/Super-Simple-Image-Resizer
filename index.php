<?php

// -- EXECUTE --

require "img_resize.php";

// - SETTINGS -
$path_src = "source/"; // source
$path_dest = "destination/"; // destination
$ratio = 0.5;
$last_stop = -1;



$a = [];
_PATH_SORT_($path_src, $a);
define("_PATH_DATA_IMAGE", $a);
$a = null;

foreach (_PATH_DATA_IMAGE[$path_src] as $k => $fe) {
  $path_src_fe = "$path_src$fe"; // source
  $path_dest_fe = "$path_dest$fe"; // destination
  if ($k > $last_stop) {
    list($w, $h) = getimagesize("$path_src$fe");
    $w = $w * $ratio;
    $h = $h * $ratio;

    image_resize($path_src_fe, $path_dest_fe, $w, $h);
  }
}

// Wird nur ausgegeben wenn fertig
echo "Last stop was at $last_stop Images\n<br>";
echo "all done";
