<?php

// -- FUNCTIONS --

function _PATH_($ipt_path, &$ret)
{
  $dir = opendir($ipt_path);
  while ($w = readdir($dir)) {
    if ($w == "." || $w == ".." || is_dir($w) && !_PATH_($ipt_path . $w . "/", $ret)) continue;
    $ret[$ipt_path][] = $w;
  }
  closedir($dir);
}

function _PATH_SORT_($ipt_path, &$ret, $ipt_sort = false)
{
  _PATH_($ipt_path, $ret);
  foreach ($ret as $k => $fe) {
    natsort($ret[$k]);
    $ret[$k] = array_values($ret[$k]);
  }
}

function image_resize($src, $dst, $width, $height, $crop = 0)
{

  if (!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

  $type = strtolower(substr(strrchr($src, "."), 1));
  if ($type == 'jpeg') $type = 'jpg';
  switch ($type) {
    case 'bmp':
      $img = imagecreatefromwbmp($src);
      break;
    case 'gif':
      $img = imagecreatefromgif($src);
      break;
    case 'jpg':
      $img = imagecreatefromjpeg($src);
      break;
    case 'png':
      $img = imagecreatefrompng($src);
      break;
    default:
      return "Unsupported picture type!";
  }

  // resize
  if ($crop) {
    if ($w < $width or $h < $height) return "Picture is too small!";
    $ratio = max($width / $w, $height / $h);
    $h = $height / $ratio;
    $x = ($w - $width / $ratio) / 2;
    $w = $width / $ratio;
  } else {
    if ($w < $width and $h < $height) return "Picture is too small!";
    $ratio = min($width / $w, $height / $h);
    $width = $w * $ratio;
    $height = $h * $ratio;
    $x = 0;
  }

  $new = imagecreatetruecolor($width, $height);

  // preserve transparency
  if ($type == "gif" or $type == "png") {
    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
    imagealphablending($new, false);
    imagesavealpha($new, true);
  }

  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

  switch ($type) {
    case 'bmp':
      imagewbmp($new, $dst);
      break;
    case 'gif':
      imagegif($new, $dst);
      break;
    case 'jpg':
      imagejpeg($new, $dst);
      break;
    case 'png':
      imagepng($new, $dst);
      break;
  }
  return true;
}
