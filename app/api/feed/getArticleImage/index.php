<?php
  $notAuth = true;
  $isCache = true;

  require_once __DIR__."/../../../autoload.php";
  // $file = file_get_contents("http://cdn.dev.classmethod.jp/wp-content/uploads/2016/05/eyecatch-sophos-discover-2016-320x320.png");
  $ext = end(explode('.', "http://cdn.dev.classmethod.jp/wp-content/uploads/2016/05/eyecatch-sophos-discover-2016-320x320.png"));
  $ext = ($ext == 'jpg') ? "jpeg" : $ext;

  switch ($ext) {
    case 'png':
      $in = imagecreatefrompng("http://cdn.dev.classmethod.jp/wp-content/uploads/2016/05/eyecatch-sophos-discover-2016-320x320.png");
      break;

    case 'jpeg':
      $in = imagecreatefromjpeg("http://cdn.dev.classmethod.jp/wp-content/uploads/2016/05/eyecatch-sophos-discover-2016-320x320.png");
      break;
  }

  $width = ImageSx($in); // 画像の幅を取得
  $height = ImageSy($in); // 画像の高さを取得
  $min_width = 82; // 幅の最低サイズ
  $min_height = 82; // 高さの最低サイズ

  if($width == $height) {
    $new_width = $min_width;
    $new_height = $min_height;
  } else if($width > $height) {//横長の場合
    $new_width = $min_width;
    $new_height = $height*($min_width/$width);
  } else if($width < $height) {//縦長の場合
    $new_width = $width*($min_height/$height);
    $new_height = $min_height;
  }
  $out = ImageCreateTrueColor($new_width , $new_height);
  ImageCopyResampled($out, $in,0,0,0,0, $new_width, $new_height, $width, $height);


  header('Last-Modified: Fri Jan 01 2016 00:00:00 GMT');
  header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + 155520000));
  header('Cache-Control: private, max-age=' . 155520000);
  header('Pragma: ');

  header('Content-Type: image/jpeg');
  header("Content-Type: image/" . $ext);

  switch ($ext) {
    case 'png':
      imagepng($out , NULL);
      break;

    case 'jpeg':
      imagejpeg($out, NULL);
      break;
    default:
      echo "wei";
  }
  // readfile("http://cdn.dev.classmethod.jp/wp-content/uploads/2016/05/eyecatch-sophos-discover-2016-320x320.png");